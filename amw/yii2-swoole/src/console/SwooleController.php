<?php
/**
 * Created by PhpStorm.
 * @author: pf <576970513@qq.com>
 * Date: 2019/10/15
 * Time: 13:03
 */
namespace amw\controllers;

use amw\swoole\Server;
use amw\web\Session;
use amw\web\Dispatcher;
use amw\web\Logger;
use Yii;
use yii\base\ExitException;
use yii\console\Controller;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\web\Application;
use yii\web\UploadedFile;
use amw\web\Request;
use amw\web\Response;

class SwooleController extends Controller {


    /* @var $port integer 监听端口*/
    public $port = 9999;

    /* @var $host string 监听IP*/
    public $host = '0.0.0.0';

    public $mode = SWOOLE_PROCESS;

    public $socketType = SWOOLE_SOCK_TCP;

    //yii2项目根路径;
    public $rootDir = '';

    public $type = 'advanced';

    public $app = 'frontend';

    public $web = "web";

    //是否开启debug
    public $debug = true;

    //环境，dev或者prod...
    public $env = 'dev';

    public $swooleConfig = [];

    //启动session回收的间隔时间，单位为毫秒
    public $gcSessionInterval = 60000;


    /**
     * 创建swoole服务器
     *
     * @throws \yii\base\Exception
     */
    public function actionStart() {
        if( $this->getPid() !== false ){
            $this->stderr("server already  started");
            exit(1);
        }

        $pidDir = dirname($this->swooleConfig['pid_file']);
        if( !file_exists($pidDir) ) FileHelper::createDirectory($pidDir);

        $logDir = dirname($this->swooleConfig['log_file']);
        if( !file_exists($logDir) ) FileHelper::createDirectory($logDir);

        //yii2项目根目录
        $rootDir = $this->rootDir;
        $web = $rootDir . $this->app . DIRECTORY_SEPARATOR . $this->web;

        $config = $this->requireConfig();
        $this->swooleConfig = array_merge([
            'document_root' => $web,
            'enable_static_handler' => true,
        ], $this->swooleConfig);
        $server = new Server($this->host, $this->port, $this->mode, $this->socketType, $this->swooleConfig);
        $server->runApp = function ($request, $response) use ($config, $web) {
            $yiiBeginAt = microtime(true);
            $aliases = [
                '@web' => '',
                '@webroot' => $web,
            ];
            $config['aliases'] = isset($config['aliases']) ? array_merge($aliases, $config['aliases']) : $aliases;

            $requestComponent = [
                'class' => Request::className(),
                'swooleRequest' => $request
            ];
            $config['components']['request'] = isset($config['components']['request']) ? array_merge($config['components']['request'], $requestComponent) : $requestComponent;

            $responseComponent = [
                'class' => Response::className(),
                'swooleResponse' => $response
            ];
            $config['components']['response'] = isset($config['components']['response']) ? array_merge($config['components']['response'], $responseComponent) : $responseComponent;
            $config['components']['session'] = isset($config['components']['session']) ? array_merge(['savePath'=>$web . '/../runtime/session'], $config['components']['session'],  ["class" => Session::className()]) :  ["class" => Session::className(), 'savePath'=>$web . '/../session'];
            if( isset($config['components']['log']) ){
                $config['components']['log'] = array_merge($config['components']['log'], ["class" => Dispatcher::className(), 'logger' => Logger::className()]);
            }

            try {
                $application = new Application($config);
                yii::$app->getLog()->yiiBeginAt = $yiiBeginAt;
                yii::$app->setAliases($aliases);
                try {
                    $application->state = Application::STATE_BEFORE_REQUEST;
                    $application->trigger(Application::EVENT_BEFORE_REQUEST);

                    $application->state = Application::STATE_HANDLING_REQUEST;
                    $yiiresponse = $application->handleRequest($application->getRequest());

                    $application->state = Application::STATE_AFTER_REQUEST;
                    $application->trigger(Application::EVENT_AFTER_REQUEST);

                    $application->state = Application::STATE_SENDING_RESPONSE;

                    $yiiresponse->send();

                    $application->state = Application::STATE_END;
                } catch (ExitException $e) {
                    $application->end($e->statusCode, isset($yiiresponse) ? $yiiresponse : null);
                }
                yii::$app->getDb()->close();
                UploadedFile::reset();
                yii::$app->getLog()->getLogger()->flush();
                yii::$app->getLog()->getLogger()->flush(true);
            }catch (\Exception $e){
                yii::$app->getErrorHandler()->handleException($e);
            }
        };
        $this->stdout("server is running, listening {$this->host}:{$this->port}" . PHP_EOL);
        $server->run();
    }


    /**
     * 停止swoole服务器
     */
    public function actionStop() {
        $this->sendSignal(SIGTERM);
        $this->stdout("server is stopped, stop listening {$this->host}:{$this->port}" . PHP_EOL);
    }


    /**
     *重新启动swoole
     */
    public function actionRestart() {
        $this->sendSignal(SIGTERM);
        $time = 0;
        while (posix_getpgid($this->getPid()) && $time <= 10) {
            usleep(100000);
            $time++;
        }
        if ($time > 100) {
            $this->stderr("Server stopped timeout" . PHP_EOL);
            exit(1);
        }
        if( $this->getPid() === false ){
            $this->stdout("Server is stopped success" . PHP_EOL);
        }else{
            $this->stderr("Server stopped error, please handle kill process" . PHP_EOL);
        }
        $this->actionStart();
    }


    /**
     * 重新启动异步进程
     */
    public function actioReloadTask()
    {
        $this->sendSignal(SIGUSR2);
    }

    private function sendSignal($sig)
    {
        if ($pid = $this->getPid()) {
            posix_kill($pid, $sig);
        } else {
            $this->stdout("server is not running!" . PHP_EOL);
            exit(1);
        }
    }


    private function getPid()
    {
        $pid_file = $this->swooleConfig['pid_file'];
        if (file_exists($pid_file)) {
            $pid = file_get_contents($pid_file);
            if (posix_getpgid($pid)) {
                return $pid;
            } else {
                unlink($pid_file);
            }
        }
        return false;
    }


    /**
     * 引入对应的配置文件
     */
    private function requireConfig() {
        $rootDir = $this->rootDir;
        defined('YII_DEBUG') or define('YII_DEBUG', $this->debug);
        defined('YII_ENV') or define('YII_ENV', $this->env);

        require($rootDir . '/vendor/autoload.php');
        //require($rootDir . '/vendor/yiisoft/yii2/Yii.php');
        if( $this->type == 'basic' ){
            $config = require($rootDir . '/config/web.php');
        }else {
            require($rootDir . '/common/config/bootstrap.php');
            require($rootDir . $this->app . '/config/bootstrap.php');

            $config = ArrayHelper::merge(
                require($rootDir . '/common/config/main.php'),
                require($rootDir . '/common/config/main-local.php'),
                require($rootDir . $this->app . '/config/main.php'),
                require($rootDir . $this->app . '/config/main-local.php')
            );
        }
        return $config;
    }


}