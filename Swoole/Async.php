<?php
/**
 * 异步回调在swoole4.3以后就不再维护并移除
 * @author: pf <576970513@qq.com>
 * Date: 2019/10/9
 * Time: 14:00
 */
declare(strict_types = 1);

namespace Swoole;

/**
 * Class Async
 * @package Swoole
 */
class Async {


    /**
     * 异步读取文件内容
     * @param string $filename
     * @param mixed $callback
     */
    public static function readFile(string $filename, callable $callback) {}


    /**
     * 异步写文件，调用此函数后会立即返回
     *
     * @param string $filename
     * @param string $fileContent
     * @param callable|null $callback
     * @param int $flags
     */
    public static function writeFile(string $filename, string $fileContent, callable $callback = null, int $flags = 0) {}


    /**
     * 异步读文件，使用此函数读取文件是非阻塞的，当读操作完成时会自动回调指定的函数。
     *
     * @param string $filename
     * @param mixed $callback
     * @param int $size
     * @param int $offset
     */
    public static function read(string $filename, callable $callback, int $size = 8192, int $offset = 0) {}


    /**
     * 异步写文件，与swoole_async_writefile不同，swoole_async_write是分段写的
     *
     * @param string $filename
     * @param string $content
     * @param int $offset
     * @param mixed|NULL $callback
     */
    public static function write(string $filename, string $content, int $offset = -1, mixed $callback = NULL) {}


    /**
     * 异步执行Shell命令
     *
     * @param string $command
     * @param callable $callback
     */
    public static function exec(string $command, callable $callback) {}

}