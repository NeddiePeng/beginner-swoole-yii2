<?php
/**
 * Created by PhpStorm.
 * @author pf <576970513@qq.com>
 * Date: 2019/9/27 14:00
 */
declare(strict_types = 1);

namespace Swoole\Http;

class Request {


    public $fd;

    public $server;

    public $reactor_id;

    public $get;

    public $post;

    public $cookie;

    public $files;

    public $tmpfiles;

    public $header;


    public function rawContent() {}

    public function getData() {}

}