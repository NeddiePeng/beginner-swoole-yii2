<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-12-23 12:24
 */

namespace amw\web;

class Dispatcher extends \yii\log\Dispatcher
{
    public $yiiBeginAt;

    public function getElapsedTime()
    {
        return microtime(true) - $this->yiiBeginAt;
    }
}