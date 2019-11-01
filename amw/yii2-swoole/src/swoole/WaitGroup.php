<?php
/**
 * Created by PhpStorm.
 * @author: pf <576970513@qq.com>
 * Date: 2019/10/15
 * Time: 18:27
 */
declare(strict_types = 1);

namespace amw\swoole;

use Swoole\Coroutine\Channel;

class WaitGroup {

    /* @var $count integer 协程总数量 */
    private $count = 0;

    /* @var $chan Channel */
    private $chan;

    /**
     * waitgroup constructor.
     * @desc 初始化一个channel
     */
    public function __construct()
    {
        $this->chan = new Channel();
    }


    /**
     * 增加协程数量
     *
     * @param int $count
     */
    public function add(int $count)
    {
        $this->count = $count;
    }


    /**
     * 添加一个协程
     */
    public function done()
    {
        $this->chan->push(true);
    }


    /**
     * 从协程中获取数据
     */
    public function wait()
    {
        while($this->count--)
        {
            $this->chan->pop();
        }
    }

}