<?php
/**
 * Created by PhpStorm.
 * @author pf <576970513@qq.com>
 * Date: 2019/10/7 11:37
 */
declare(strict_types = 1);

namespace Swoole\Coroutine;

class Channel {


    public $errCode;

    public $capacity;

    /**
     * Channel constructor.
     * @param int $capacity
     */
    public function __construct(int $capacity  = 1) {}

    /**
     * 向通道中写入数据
     *
     * @param       $data
     * @param float $timeout
     * @author pf <576970513@qq.com>
     */
    public function push($data, float $timeout = -1) {}

    /**
     * 在通道中读取数据
     *
     * @param float $timeout
     * @author pf <576970513@qq.com>
     */
    public function pop(float $timeout = 0) {}

    /**
     * 获取通道状态
     *
     * @author pf <576970513@qq.com>
     */
    public function status() {}

    /**
     * 关闭通道。并唤醒所有等待读写的协程
     *
     * @author pf <576970513@qq.com>
     */
    public function close() {}

    /**
     * 获取通道中的元素数量
     *
     * @author pf <576970513@qq.com>
     */
    public function length() {}

    /**
     * 判断当前通道是否为空
     *
     * @author pf <576970513@qq.com>
     */
    public function isEmpty() {}

    /**
     * 判断当前通道是否已满
     *
     * @author pf <576970513@qq.com>
     */
    public function isFull() {}

}
