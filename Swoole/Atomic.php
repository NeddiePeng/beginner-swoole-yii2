<?php
/**
 * Created by PhpStorm.
 * @author: pf <576970513@qq.com>
 * Date: 2019/10/8
 * Time: 10:07
 */
declare(strict_types = 1);

namespace Swoole;

class Atomic {


    /**
     * 创建一个原子计数对象
     *
     * Atomic constructor.
     * @param int $init_value
     */
    public function __construct(int $init_value = 0) {}


    /**
     * 增加计数器
     *
     * @param int $add_value
     */
    public function add(int $add_value = 1) {}


    /**
     * 减少计数
     *
     * @param int $sub_value
     */
    public function sub(int $sub_value = 1) {}


    /**
     * 返回当前计数的值
     *
     * @return mixed
     */
    public function get() {}


    /**
     * 将当前值设置为指定的数字
     *
     * @param int $value
     */
    public function set(int $value) {}


    /**
     * 如果当前数值等于参数1，则将当前数值设置为参数2
     *
     * @param int $cmp_value
     * @param int $set_value
     * @return boolean
     */
    public function cmpset(int $cmp_value, int $set_value) {}


    /**
     * @param float $timeout
     */
    public function wait(float $timeout = 1.0) {}


    /**
     * 唤醒处于wait状态的其他进程。
     *
     * @param int $n
     */
    public function wakeup(int $n = 1) {}





}