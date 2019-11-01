<?php
/**
 * Created by PhpStorm.
 * @author pf <576970513@qq.com>
 * Date: 2019/9/27 23:01
 */
declare(strict_types = 1);

namespace Swoole;

class Coroutine {

    public function sleep(float $time) {}

    /**
     * 获取到协程的ID[getCid的别名]
     *
     * @author pf <576970513@qq.com>
     * @date   2019/10/7 11:30
     */
    public static function getUid() {}

    public static function set(array $settings = []) {}

    /**
     * 创建一个协程
     *
     * @param callable   $callable
     * @param array|null $params
     * @author pf <576970513@qq.com>
     */
    public static function create(callable $callable, array $params = null) {}

    /**
     * defer用于资源的释放, 会在协程关闭之前(即协程函数执行完毕时)进行调用, 就算抛出了异常, 已注册的defer也会被执行
     *
     * @param callable $callable
     * @author pf <576970513@qq.com>
     */
    public static function defer(callable $callable) {}

    /**
     * 检查指定协程是否存在
     *
     * @param int $cid
     * @author pf <576970513@qq.com>
     */
    public static function exists(int $cid = 0) {}

    public static function getCid() {}

    public static function getPcid() {}

    public static function getContext() {}

    public static function yield() {}

    /**
     * yield的别名
     *
     * @author pf <576970513@qq.com>
     * @date   2019/10/7 11:29
     */
    public static function suspend() {}

    public static function resume(int $cid) {}

    public static function list() {}

    public static function listCoroutines() {}

    public static function stats() {}

    public static function getBackTrace(int $cid = 0, int $options = DEBUG_BACKTRACE_PROVIDE_OBJECT, int $limit = 0) {}

}