<?php
/**
 * Created by PhpStorm.
 * @author: pf <576970513@qq.com>
 * Date: 2019/10/11
 * Time: 15:49
 */
declare(strict_types = 1);

namespace Swoole\WebSocket;

class CloseFrame extends Frame {

    public $fd;

    public $data;

    public $opcode;

    public $finish;

    public $code;

    public $reason;


}