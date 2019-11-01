<?php
/**
 * Created by PhpStorm.
 * @author: pf <576970513@qq.com>
 * Date: 2019/10/15
 * Time: 14:02
 */
declare(strict_types = 1);

namespace amw\swoole;

use amw\web\Session;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server as SwooleServer;

class Server {

    public $swoole;

    public $webRoot;

    public $config = ['gcSessionInterval' => 60000];

    public $runApp;

    public function __construct($host, $port, $mode, $socketType, $swooleConfig = [], $config = [])
    {
        $this->swoole = new SwooleServer($host, $port, $mode, $socketType);
        $this->webRoot = $swooleConfig['document_root'];
        if( !empty($this->config) ) $this->config = array_merge($this->config, $config);
        $this->swoole->set($swooleConfig);
        $this->swoole->on('request', [$this, 'onRequest']);
        $this->swoole->on('WorkerStart', [$this, 'onWorkerStart']);
    }

    public function run() {
        $this->swoole->start();
    }


    public function onRequest(Request $request, Response $response) {
        $this->mountGlobalFilesVar($request);

        call_user_func_array($this->runApp, [$request, $response]);
    }


    public function onWorkerStart(SwooleServer $server, int $worker_id) {
        if( $worker_id == 0 ) {
            $server->tick($this->config['gcSessionInterval'], function(){//一分钟清理一次session
                (new Session())->gcSession();
            });
        }
    }

    /**
     * @param Request $request
     */
    private function mountGlobalFilesVar(Request $request)
    {
        if( isset($request->files) ) {
            $files = $request->files;
            foreach ($files as $k => $v) {
                if( isset($v['name']) ){
                    $_FILES = $files;
                    break;
                }
                foreach ($v as $key => $val) {
                    $_FILES[$k]['name'][$key] = $val['name'];
                    $_FILES[$k]['type'][$key] = $val['type'];
                    $_FILES[$k]['tmp_name'][$key] = $val['tmp_name'];
                    $_FILES[$k]['size'][$key] = $val['size'];
                    if(isset($val['error'])) $_FILES[$k]['error'][$key] = $val['error'];
                }
            }
        }
        $_GET = isset($request->get) ? $request->get : [];
        $_POST = isset($request->post) ?  $request->post : [];
        $_COOKIE = isset($request->cookie) ?  $request->cookie : [];

        $server = isset($request->server) ? $request->server : [];
        $header = isset($request->header) ? $request->header : [];
        foreach ($server as $key => $value) {
            $_SERVER[strtoupper($key)] = $value;
            unset($server[$key]);
        }
        foreach ($header as $key => $value) {
            $_SERVER['HTTP_'.strtoupper($key)] = $value;
        }
        $_SERVER['SERVER_SOFTWARE'] = "swoole/" . SWOOLE_VERSION;
    }

}