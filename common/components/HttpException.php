<?php
/**
 * Created by PhpStorm.
 * @author: pf <576970513@qq.com>
 * Date: 2019/11/1
 * Time: 11:23
 */
declare(strict_types = 1);

namespace common\components;

use yii\web\HttpException as BaseHttpException;

class HttpException extends BaseHttpException {

    public function __construct($status, $message = null, $code = 0, \Exception $previous = null)
    {
        $this->statusCode = $status;
        parent::__construct($status, $message, $code, $previous);
    }

}