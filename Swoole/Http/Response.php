<?php
/**
 * Created by PhpStorm.
 * @author pf <576970513@qq.com>
 * Date: 2019/9/27 17:32
 */
declare(strict_types = 1);

namespace Swoole\Http;

class Response {


    public $fd;

    public $socket;

    public $header;

    public $cookie;

    public $trailer;


    public function header($key, $value) {}


    public function end(string $content = null) {}

    public function cookie(string $key, string $value = null, int $expire = 0 , string $path = null, string $domain  = null, bool $secure = false , bool $httponly = false, string $samesite = null) {}


    public function status(int $http_status_code) {}

    public function gzip(int $level = 1) {}

    public function redirect(string $url, int $http_code = 302) {}

    public function write(string $data) {}

    public function sendfile(string $filename, int $offset = 0, int $length = 0) {}

    public function detach() {}

    public function upgrade() {}

    public function recv() {}

    public function push($data, int $opcode = 1, bool $finish = true) {}

    public static function create(int $fd){}


}