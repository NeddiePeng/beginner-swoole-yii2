<?php
/**
 * Created by PhpStorm.
 * @author pf <576970513@qq.com>
 * Date: 2019/10/7 17:36
 */
declare(strict_types = 1);

namespace Swoole\Coroutine;

class System {

    /**
     * 获取文件系统信息
     *
     * @param string $path
     * @author pf <576970513@qq.com>
     */
    public static function statvfs(string $path) {}

    /**
     * 协程方式读取文件
     *
     * @author pf <576970513@qq.com>
     */
    public static function fread(resource $handle, int $length = 0) {}

    /**
     * 协程方式向文件写入数据
     *
     * @param resource $handle
     * @param string   $data
     * @param int      $length
     * @author pf <576970513@qq.com>
     */
    public static function fwrite(resource $handle, string $data, int $length = 0) {}

    /**
     * @param resource $handle
     * @author pf <576970513@qq.com>
     */
    public static function fgets(resource $handle) {}

    /**
     * 协程方式读取文件
     *
     * @author pf <576970513@qq.com>
     */
    public static function readFile(string $filename) {}

    /**
     * 协程方式写入文件
     *
     * @param string $filename
     * @param string $fileContent
     * @param int    $flags
     * @author pf <576970513@qq.com>
     */
    public static function writeFile(string $filename, string $fileContent, int $flags) {}

    /**
     * 进入等待状态
     *
     * @param float $seconds
     * @author pf <576970513@qq.com>
     */
    public static function sleep(float $seconds) {}

    /**
     * 执行一条shell指令。底层自动进行协程调度。
     *
     * @param string $cmd
     * @author pf <576970513@qq.com>
     */
    public static function exec(string $cmd) {}

    /**
     * 将域名解析为IP，基于同步的线程池模拟实现。底层自动进行协程调度。
     *
     * @param string $domain
     * @param int    $family
     * @param float  $timeout
     * @author pf <576970513@qq.com>
     */
    public static function gethostbyname(string $domain, int $family = AF_INET, float $timeout) {}

    /**
     * 进行DNS解析，查询域名对应的IP地址，与gethostbyname不同，getaddrinfo支持更多参数设置，而且会返回多个IP结果
     *
     * @param string      $domain
     * @param int         $family
     * @param int         $socktype
     * @param int         $protocol
     * @param string|null $service
     * @author pf <576970513@qq.com>
     */
    public static function getaddrinfo(string $domain, int $family = AF_INET, int $socktype = SOCK_STREAM,
                                       int $protocol = IPPROTO_TCP, string $service = null) {}

    /**
     * 域名地址查询
     *
     * @param string $domain
     * @param float  $timeout
     * @author pf <576970513@qq.com>
     */
    public static function dnsLookup(string $domain, float $timeout = 5) {}



}