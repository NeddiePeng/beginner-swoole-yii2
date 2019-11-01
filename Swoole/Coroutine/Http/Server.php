<?php
/**
 * Created by PhpStorm.
 * @author pf <576970513@qq.com>
 * Date: 2019/10/7 14:52
 */
declare(strict_types = 1);

namespace Swoole\Coroutine\Http;

use Swoole\Coroutine\Server as CoServer;

class Server  extends CoServer {

    /**
     * 设置连接处理函数
     *
     * @param string   $pattern  /websocket
     * @param callable $fn
     * @author pf <576970513@qq.com>
     */
    public function handle(string $pattern, callable $fn) {}


}