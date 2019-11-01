##sleep/usleep的影响

在异步IO的程序中，**不得使用sleep/usleep/time_sleep_until/time_nanosleep**.

- `sleep`函数会是进程陷入睡眠阻塞
- 直到指定的时间后操作系统才会重新唤醒当前的进程
- `sleep`过程中，只有信号可以切断
- 由于`Swoole`的信号处理是基于`signalfd`实现，所以即使发送信号也无法中断`sleep`

`swoole`提供的`swoole_event_add`、`swoole_timer_tick`、`swoole_timer_after`、
`swoole_process::signal`、`异步swoole_client`在进程sleep后会停止工作。`swoole_server`也无法在处理新的请求




##exit/die函数的影响

如果在代码中使用`exit/die`,当前工作的Worker进程、Task进程、User进程、以及`swoole_process`会立即退出

使用`exit/die`后会使Worker进程因为异常退出，被master进程在一次拉起，最后是进程不断退出又不断的拉起和产生大量的警报日志。

所以建议使用`try{}catch(){}`的方式替换`exit/die`,现实中断执行跳出PHP函数调用栈
```php

function swoole_exit($msg) {
    //php-fpm的环境
    if(ENV == 'php') {
        exit($msg);
    } else {
        //swoole环境
        throw new Swoole\ExitException($mes); 
    }
}

```

异常处理的方式比`exit/die`更友好，因为异常是可控的，`exit/die`是不可控的。在最外层进程try/catch即可捕获异常，
仅终止当前的任务，Worker进程可以继续处理新的请求，而`exit/die`会导致进程直接退出，当前进程保护的所有变量和资源都会被销毁。


##while循环的影响

异步程序如果遇到死循环，事件将无法触发。异步IO程序使用`Reactor模型`，运行过程中必须在`reactor->wait`出轮询.
如果遇到死循环，程序的控制权就在while中，`reactor`无法得到控制权，无法检测事件，所以IO事件回调函数将无法触发。


##stat缓存清理

PHP底层对`stat`系统调用增加了`Cache`,在使用`stat`、`fstat`、`filemtime`等函数的时候，底层可能会命中缓存，返回历史数据。

可以使用`clearstatcache`函数清理文件stat缓存。


##mt_rand随机数

在`Swoole`中如果父进程内调用`mt_rand`,不同的子进程内在调用mt_rand返回的结果会是相同的，所以在所有子进程内调用`mt_srand`重新播种


##进程隔离

全局变量在不同的进程，内存空间是隔离的，所以修改全局变量后不生效。

- 不同的进程中PHP的变量不共享，在A进程内修改了他的值，在B进程内是无效的
- 如果需要再不同的Worker进程内共享数据，可以用`Redis`、`mysql`、`文件`、`Swoole\Table`、`APCu`、`shmget`等工具实现
- 不同进程的文件句柄是隔离的，所以在A进程内创建的Socket和打开的文件是不同享的


##捕获异常和错误

在PHP中大致有三种类型的可捕获的异常和错误

- `Error`：PHP内核抛出错误的专用类型, 如类不存在, 函数不存在, 函数参数错误, 都会抛出此类型的错误, PHP代码中不应该使用Error类来作为异常抛出
- `Exception`：应用开发者应该使用的异常基类
- `ErrorException`：此异常基类专门负责将PHP的Warning/Notice等信息通过`set_error_handler`转换成异常, 
PHP未来的规划必然是将所有的Warning/Notice转为异常, 以便于PHP程序能够更好更可控地处理各种错误


##不可捕获的致命错误和异常

PHP错误的一个重要级别, 如异常/错误未捕获时, 内存不足时, 或是一些编译期错误(继承的类不存在), 将会以E_ERROR级别抛出一个Fatal Error, 
是在程序发生不可回溯的错误时才会触发的,PHP程序无法捕获这样级别的一种错误, 只能通过`register_shutdown_function`在后续进行一些处理操作。


##在协程中捕获运行时异常/错误

在`swoole4`协程编程中，某个协程的代码中抛出错误，会导致整个进程退出，进程所有协程终止执行，
在协程顶层空间可以先进行一次try/catch捕获异常/错误。仅终止出错的协程。


`systemctl cat sshd`



