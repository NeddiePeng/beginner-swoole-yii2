<?php
/**
 * Created by PhpStorm.
 * @author: pf <576970513@qq.com>
 * Date: 2019/10/29
 * Time: 14:25
 */
namespace amw\controllers;

use amw\swoole\WebSocktServer;
use yii\console\Controller;

class WebsocketController extends Controller {

    public $port = 9998;

    public $host = '127.0.0.1';

    public $mode = SWOOLE_PROCESS;

    public $sock_type = SWOOLE_SOCK_UNIX_STREAM;

    public $swoole_config = [];


    public function actionStart() {
        $server = new WebSocktServer($this->host, $this->port, $this->mode, $this->sock_type, $this->swoole_config);
        $this->stdout("server is running, listening {$this->host}:{$this->port}" . PHP_EOL);
        $server->run();
    }

}