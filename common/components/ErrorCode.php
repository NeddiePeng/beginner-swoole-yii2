<?php
/**
 * Created by PhpStorm.
 * @author: pf <576970513@qq.com>
 * Date: 2019/11/1
 * Time: 11:28
 */
declare(strict_types=1);

namespace common\components;

use \Exception;

class ErrorCode
{

    /**
     * 错误信息
     *
     * @var array
     */
    private static $error = [
        'system_error' => [
            'status' => 500,
            'code' => 500000,
            'msg' => 'system error',
        ],
        'auth_error' => [
            'status' => 401,
            'code' => 400000,
            'msg' => 'auth error',
        ],
        'params_error' => [
            'status' => 401,
            'code' => 400001,
            'msg' => 'params error',
        ],
        'existing_error' => [
            'status' => 202,
            'code' => 200002,
            'msg' => 'Mobile number registered.'
        ]
    ];


    /**
     * @param $key
     * @return mixed
     * @throws Exception
     */
    public static function getError($key){
        if(empty($key) || !isset(self::$error[$key])){
            throw new Exception("error code not exist", 400);
        }
        return self::$error[$key];
    }


}