<?php
/**
 * Created by PhpStorm.
 * @author pf <576970513@qq.com>
 * Date: 2019/10/7 14:04
 */
declare(strict_types = 1);

namespace Swoole\Coroutine;

class Server {


    public function __construct(string $host, int $port = 0, bool $ssl = false, bool $reuse_port) {}


    public function set(array $options) {}

    /**
     * 设置连接处理函数
     *
     * @param callable $fn
     * @author pf <576970513@qq.com>
     */
    public function handle(callable $fn) {}

    /**
     * 启动服务器
     *
     * @author pf <576970513@qq.com>
     */
    public function start() {}

    /**
     * 终止服务器
     *
     * @author pf <576970513@qq.com>
     */
    public function shutdown() {}

}