<?php
/**
 * Created by PhpStorm.
 * @author pf <576970513@qq.com>
 * Date: 2019/10/7 14:15
 */
declare(strict_types = 1);

namespace Swoole\Coroutine;

class Scheduler {

    /**
     * 设置协程运行时参数
     *
     * @param array $options
     * @author pf <576970513@qq.com>
     */
    public function set(array $options) {}

    /**
     * 添加协程任务
     *
     * @param callable $fn
     * @param mixed    ...$args
     * @author pf <576970513@qq.com>
     */
    public function add(callable $fn, ... $args) {}

    /**
     * 添加并行任务
     *
     * @param int      $n
     * @param callable $fn
     * @param mixed    ...$args
     * @author pf <576970513@qq.com>
     */
    public function parallel(int $n, callable $fn, ... $args) {}

    /**
     * 启动程序
     *
     * @author pf <576970513@qq.com>
     */
    public function start() {}


}