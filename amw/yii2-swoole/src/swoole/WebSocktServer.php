<?php
/**
 * Created by PhpStorm.
 * @author: pf <576970513@qq.com>
 * Date: 2019/10/31
 * Time: 9:43
 */
declare(strict_types = 1);

namespace amw\swoole;

use Yii;
use amw\web\Tidings;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server as WebSockt;

class WebSocktServer {


    /**
     * @var WebSockt
     */
    private $server;

    public function __construct(string $host, int $port, int $mode, int $sock_type, array $config = [])
    {
        $this->server = new WebSockt($host, $port, $mode, $sock_type);
        if($config) {
            $this->server->set($config);
        }
        $this->server->on('open', [$this, 'onOpen']);
        $this->server->on('message', [$this, 'onMessage']);
        $this->server->on('close', [$this, 'onClose']);
        $this->server->on('request', [$this, 'onRequest']);
    }

    public function run() {
        $this->server->start();
    }


    public function onOpen(WebSockt $server, Request $request) {
        if($request->get['uid']) {
            $server->bind($request->fd, $request->get['uid']);
            $server->push($request->fd, "connect success {$request->fd}");
        } else {
            $server->disconnect($request->fd, 1000, 'params error.');
        }
    }

    public function onMessage(WebSockt $server, Frame $frame) {
        $client_info = $server->getClientInfo($frame->fd);
        if(!$client_info) {
            $server->push($frame->fd, 'client not connect.');
        }
        $message = json_decode($frame->data, true);
        if(count($this->server->connections) < 2) {
            $server->push($frame->fd, 'client not connect.');
        } else{
            foreach ($this->server->connections as $fd) {
                if ($this->server->isEstablished($fd)) {
                    $client_info = $server->getClientInfo($fd);
                    if($client_info && $client_info['uid'] == $message['to_uid']) {
                        $tidings = Yii::createObject(Tidings::className());
                        $tidings->send();
                        $server->push($fd, $frame->data);
                    } else {
                        $server->push($frame->fd, 'client not connect.');
                    }
                } else {
                    $server->push($frame->fd, 'client not connect.');
                }
            }
        }
    }

    public function onClose(WebSockt $server, $fd) {
        $server->push($fd, 'client close connect.');
    }

    public function onRequest(Request $request, Response $response) {
        foreach ($this->server->connections as $fd) {
            if ($this->server->isEstablished($fd)) {
                $this->server->push($fd, $request->get['message']);
            }
        }
    }

}