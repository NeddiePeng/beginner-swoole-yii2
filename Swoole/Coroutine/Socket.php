<?php
/**
 * Created by PhpStorm.
 * @author pf <576970513@qq.com>
 * Date: 2019/10/7 17:07
 */
declare(strict_types = 1);

namespace Swoole\Coroutine;

class Socket {


    public $fd;

    public $errCode;

    /**
     * Socket constructor.
     * @param int $domain
     * @param int $type
     * @param int $protocol
     */
    public function __construct(int $domain, int $type, int $protocol) {}

    /**
     * @param int $level
     * @param int $optname
     * @author pf <576970513@qq.com>
     */
    public function getOption(int $level, int $optname) {}


    /**
     *
     * @param int $level
     * @param int $optname
     * @param     $optval
     * @author pf <576970513@qq.com>
     */
    public function setOption(int $level, int $optname, $optval) {}

    /**
     * 绑定地址和端口
     *
     * @param string $address
     * @param int    $port
     * @author pf <576970513@qq.com>
     */
    public function bind(string $address, int $port = 0) {}

    /**
     * 监听Socket
     *
     * @param int $backlog
     * @author pf <576970513@qq.com>
     */
    public function listen(int $backlog = 0) {}

    /**
     * @param float $timeout
     * @author pf <576970513@qq.com>
     */
    public function accept(float $timeout = -1) {}

    /**
     * 连接到目标服务器
     *
     * @param string $host
     * @param int    $port
     * @param float  $timeout
     * @author pf <576970513@qq.com>
     */
    public function connect(string $host, int $port = 0, float $timeout = -1) {}

    /**
     * 向对端发送数据。
     *
     * @param string $data
     * @param float $timeout
     * @author pf <576970513@qq.com>
     */
    public function send(string $data, float $timeout = -1) {}

    /**
     * 向对端发送数据, 与send方法不同的是, sendAll会尽可能完整地发送数据, 直到成功发送全部数据或遇到错误中止
     *
     * @param string $data
     * @param float  $timeout
     * @author pf <576970513@qq.com>
     */
    public function sendAll(string $data, float $timeout = -1) {}

    /**
     * 接收数据
     *
     * @param int $length
     * @param float $timeout
     * @author pf <576970513@qq.com>
     */
    public function recv(int $length = 65535, float $timeout = -1) {}

    /**
     * @param int $length
     * @param float $timeout
     * @author pf <576970513@qq.com>
     */
    public function recvAll(int $length = 65535, float $timeout = -1) {}

    /**
     * 向指定的地址和端口发送数据
     *
     * @param string $address
     * @param int    $port
     * @param string $data
     * @author pf <576970513@qq.com>
     */
    public function sendto(string $address, int $port, string $data) {}

    /**
     * 接收数据，并设置来源主机的地址和端口。用于SOCK_DGRAM类型的socket
     *
     * @param array $peer
     * @param float $timeout
     * @author pf <576970513@qq.com>
     */
    public function recvfrom(array &$peer, float $timeout = -1) {}

    /**
     * 获取socket的地址和端口信息
     *
     * @author pf <576970513@qq.com>
     * @date   2019/10/7 17:30
     * @since  1.0
     */
    public function getsockname() {}

    /**
     * 获取socket的对端地址和端口信息，仅用于SOCK_STREAM类型有连接的socket
     *
     * @author pf <576970513@qq.com>
     */
    public function getpeername() {}

    /**
     * 关闭Socket
     *
     * @author pf <576970513@qq.com>
     */
    public function close() {}

}