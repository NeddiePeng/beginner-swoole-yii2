<?php
/**
 * Created by PhpStorm.
 * @author: pf <576970513@qq.com>
 * Date: 2019/10/8
 * Time: 13:00
 */
declare(strict_types = 1);

namespace Swoole;

class Lock {

    const SWOOLE_MUTEX = 3;
    const SWOOLE_FILELOCK = 2;
    const SWOOLE_SEM = 4;
    const SWOOLE_RWLOCK = 1;
    const SWOOLE_SPINLOCK = 5;


    /**
     * Lock constructor.
     * @param int $type
     * @param string $lockfile
     */
    public function __construct(int $type = self::SWOOLE_MUTEX, string $lockfile = '')
    {
    }


    /**
     * 加锁操作
     * @return  boolean
     */
    public function lock() {}


    /**
     * 加锁操作。与lock方法不同的是，trylock()不会阻塞，它会立即返回
     *
     * @return boolean
     */
    public function trylock() {}


    /**
     * 释放锁
     * @return boolean
     */
    public function unlock() {}


    /**
     * 只读加锁
     */
    public function lock_read() {}


    /**
     * 加锁。此方法与lock_read相同，但是非阻塞的。
     */
    public function trylock_read() {}


    /**
     * 加锁操作，作用与lock方法一致，但lockwait可以设置超时时间。
     */
    public function lockwait() {}

}