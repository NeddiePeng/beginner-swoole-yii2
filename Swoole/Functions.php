<?php
/**
 * Created by PhpStorm.
 * @author: pf <576970513@qq.com>
 * Date: 2019/10/15
 * Time: 18:47
 */

declare(strict_types = 1);

use Swoole\Coroutine;

/**
 * 创建协程
 */
if (! function_exists('co')) {
    function co(callable $callable)
    {
        Coroutine::create($callable);
    }
}

/**
 * 创建协程
 */
if (!function_exists('go')) {
    function go (callable $callable)
    {
        Coroutine::create($callable);
    }
}

/**
 * 资源释放
 */
if(!function_exists('defer')) {
    function defer(callable $callable): void
    {
        Coroutine::defer($callable);
    }
}

if (! function_exists('value')) {
    /**
     * 获取变量的值允许value为函数
     * @param $value
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}


if (! function_exists('env')) {
    /**
     * 获取环境变量的值
     *
     * @param $key
     * @param null $default
     * @return array|bool|false|string|void
     */
    function env($key, $default = null)
    {
        $value = getenv($key);
        if ($value === false) {
            return value($default);
        }
        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return;
        }
        if (($valueLength = strlen($value)) > 1 && $value[0] === '"' && $value[$valueLength - 1] === '"') {
            return substr($value, 1, -1);
        }
        return $value;
    }
}

