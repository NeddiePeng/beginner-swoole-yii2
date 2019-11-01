<?php
/**
 * Created by PhpStorm.
 * @author: pf <576970513@qq.com>
 * Date: 2019/10/8
 * Time: 17:50
 */
declare(strict_types = 1);

namespace Swoole;

class Process {

    const SOCK_NONE = 0;
    const SOCK_DGRAM = 2;
    const SOCK_STREAM = 1;


    public $pid;
    public $pipe;


    /**
     * 创建子进程
     *
     * Process constructor.
     * @param callable $function
     * @param bool $redirect_stdin_stdout
     * @param int $pipe_type
     * @param bool $enable_coroutine
     */
    public function __construct(callable $function, bool $redirect_stdin_stdout = false, int $pipe_type = self::SOCK_DGRAM, bool $enable_coroutine = false)
    {}


    /**
     * 执行fork系统调用，启动进程。
     */
    public function start() {}


    /**
     * 修改进程名称。此函数是swoole_set_process_name的别名
     */
    public function name() {}


    /**
     * 执行一个外部程序，此函数是exec系统调用的封装。
     *
     * @param string $execfile
     * @param array $args
     */
    public function exec(string $execfile, array $args) {}


    /**
     * 管道内写入数据
     *
     * @param string $data
     */
    public function write(string $data) {}

    /**
     * 从管道中读取数据
     *
     * @param int $buffer_size
     */
    public function read(int $buffer_size = 8192) {}


    /**
     * 设置管道读写操作的超时时间。
     *
     * @param double $timeout
     */
    public function setTimeout(double $timeout) {}


    /**
     * 设置管道是否为阻塞模式
     *
     * @param bool $blocking
     */
    public function setBlocking(bool $blocking = true) {}


    /**
     * 启用消息队列作为进程间通信。
     *
     * @param int $msgkey
     * @param int $mode
     * @param int $capacity
     */
    public function useQueue(int $msgkey = 0, int $mode = 2, int $capacity = 8192) {}


    /**
     * 查看消息队列状态。
     */
    public function statQueue() {}


    /**
     * 删除队列
     */
    public function freeQueue() {}


    /**
     * 将管道导出为Coroutine\Socket对象。
     */
    public function exportSocket() {}


    /**
     * 投递数据到消息队列中。
     *
     * @param string $data
     */
    public function push(string $data) {}


    /**
     * 从队列中提取数据
     *
     * @param int $maxsize
     */
    public function pop(int $maxsize = 8192) {}


    /**
     * 用于关闭创建的好的管道。
     *
     * @param int $which
     */
    public function close(int $which = 0) {}


    /**
     * 退出子进程
     *
     * @param int $status
     */
    public function exit(int $status = 0) {}


    /**
     * 向指定pid进程发送信号
     *
     * @param $pid
     * @param int $signo
     */
    public static function kill($pid, $signo = SIGTERM) {}


    /**
     * 回收结束运行的子进程。
     *
     * @param bool $blocking
     */
    public static function wait(bool $blocking = true) {}


    /**
     * 使当前进程蜕变为一个守护进程。
     *
     * @param bool $nochdir
     * @param bool $noclose
     */
    public static function daemon(bool $nochdir = true, bool $noclose = true) {}


    /**
     * 设置异步信号监听。
     *
     * @param int $signo
     * @param callable $callback
     */
    public static function signal(int $signo, callable $callback) {}


    /**
     * 高精度定时器，是操作系统setitimer系统调用的封装，可以设置微秒级别的定时器
     *
     * @param int $interval_usec
     * @param int $type
     */
    public static function alarm(int $interval_usec, int $type = ITIMER_REAL) {}


    /**
     * 设置CPU亲和性，可以将进程绑定到特定的CPU核上
     *
     * @param array $cpu_set
     */
    public static function setAffinity(array $cpu_set) {}


}