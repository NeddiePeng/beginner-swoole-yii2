<?php
/**
 * Created by PhpStorm.
 * @author: pf <576970513@qq.com>
 * Date: 2019/10/9
 * Time: 1:09
 */
declare(strict_types = 1);

namespace Swoole\Process;

class Pool {


    /**
     * 创建进程池
     *
     * Pool constructor.
     * @param int $worker_num
     * @param int $ipc_type
     * @param int $msgqueue_key
     * @param bool $enable_coroutine
     */
    public function __construct(int $worker_num, int $ipc_type = 0, int $msgqueue_key = 0, bool $enable_coroutine = false)
    {}


    /**
     * 设置进程池回调函数。
     *
     * @param string $event
     * @param callable $function
     */
    public function on(string $event, callable $function) {}


    /**
     * 监听SOCKET，必须在$ipc_mode为SWOOLE_IPC_SOCKET时才能使用
     *
     * @param string $host
     * @param int $port
     * @param int $backlog
     */
    public function listen(string $host, int $port = 0, int $backlog = 2048) {}


    /**
     * 向对端写入数据，必须在$ipc_mode为SWOOLE_IPC_SOCKET时才能使用。
     *
     * @param string $data
     */
    public function write(string $data) {}


    /**
     * 启动工作进程
     */
    public function start() {}


    /**
     * 获取当前工作进程对象。返回Swoole\Process对象
     *
     * @param $worker_id
     */
    public function getProcess($worker_id) {}

}