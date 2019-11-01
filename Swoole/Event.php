<?php
/**
 * Created by PhpStorm.
 * @author pf <576970513@qq.com>
 * Date: 2019/10/7 11:54
 */
declare(strict_types = 1);

namespace Swoole;

class Event {

    /**
     * 将一个socket加入到底层的reactor事件监听中
     *
     * @param mixed $sock
     * @param mixed $read_callback
     * @param mixed|null $write_callback
     * @param int|null $flags
     */
    public static function add(mixed $sock, mixed $read_callback, mixed $write_callback = null, int $flags = null) {}


    /**
     * 修改事件监听的回调函数和掩码
     *
     * @param $fd
     * @param mixed $read_callback
     * @param mixed $write_callback
     * @param int $flags
     */
    public static function set($fd, mixed $read_callback, mixed $write_callback, int $flags) {}


    /**
     * 检测传入的$fd是否已加入了事件监听
     *
     * @param mixed $fd
     * @param int $events
     */
    public static function isset(mixed $fd, int $events = SWOOLE_EVENT_READ | SWOOLE_EVENT_WRITE) {}


    /**
     * @param int $fd
     * @param $data
     */
    public static function write(int $fd, $data) {}


    /**
     * 从reactor中移除监听的socket
     *
     * @param mixed $sock
     */
    public static function del(mixed $sock) {}


    /**
     * 退出事件轮询，此函数仅在Client程序中有效
     */
    public static function exit() {}


    /**
     * 在下一个事件循环开始时执行函数
     *
     * @param mixed $callback_function
     */
    public static function defer(mixed $callback_function) {}


    /**
     * 定义事件循环周期执行函数。此函数会在每一轮事件循环结束时调用
     *
     * @param callable $callback
     * @param bool $before
     */
    public static function cycle(callable $callback, bool $before = false) {}

    /**
     * 启动事件监听，请将此函数放置于PHP程序末尾。
     */
    public static function wait() {}

    /**
     * 仅执行一次reactor->wait操作，在Linux平台下相当手工调用一次epoll_wait。
     * 与swoole_event_dispatch不同的是，swoole_event_wait在底层内部维持了循环。
     */
    public static function dispatch() {}



}