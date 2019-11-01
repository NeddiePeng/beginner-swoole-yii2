<?php
/**
 * Created by PhpStorm.
 * @author pf <576970513@qq.com>
 * Date: 2019/9/27 17:51
 */
declare(strict_types = 1);

namespace Swoole\WebSocket;

class Frame {

    public $fd;

    public $data;

    public $opcode;

    public $finish;

}