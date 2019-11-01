<?php
/**
 * Created by PhpStorm.
 * @author pf <576970513@qq.com>
 * Date: 2019/10/7 18:27
 */
declare(strict_types = 1);

namespace Swoole;

class Timer {

    /**
     * 设置一个间隔时钟定时器，与after定时器不同的是tick定时器会持续触发，直到调用Timer::clear清除
     *
     * @param int      $msec
     * @param callable $callback
     * @param mixed    ...$params
     * @author pf <576970513@qq.com>
     */
    public static function tick(int $msec, callable $callback, ...$params) {}

    /**
     * 在指定的时间后执行函数
     *
     * @param int      $after_time_ms
     * @param callable $callback_function
     * @param mixed    ...$params
     * @author pf <576970513@qq.com>
     */
    public static function after(int $after_time_ms, callable $callback_function, ...$params) {}

    /**
     * 使用定时器ID来删除定时器
     *
     * @author pf <576970513@qq.com>
     */
    public static function clear(int $timer_id) {}

    /**
     * 清除所有的定时器
     *
     * @author pf <576970513@qq.com>
     */
    public static function clearAll() {}

    /**
     * 返回timer的信息
     *
     * @author pf <576970513@qq.com>
     */
    public static function info() {}

    /**
     * 返回定时器迭代器, 可使用foreach遍历全局所有timer的id
     *
     * @author pf <576970513@qq.com>
     */
    public static function list() {}


    public static function stats() {}

}