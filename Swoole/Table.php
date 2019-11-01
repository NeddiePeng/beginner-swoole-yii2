<?php
/**
 * Created by PhpStorm.
 * @author pf <576970513@qq.com>
 * Date: 2019/10/8 9:12
 */
declare(strict_types = 1);

namespace Swoole;

class Table {

    const TYPE_STRING = 7;
    const TYPE_INT = 1;
    const TYPE_FLOAT = 6;

    /**
     * 实际占用内存的尺寸
     */
    public $memorySize;


    /**
     * 创建内存表
     *
     * Table constructor.
     * @param int   $size
     * @param float $conflict_proportion
     */
    public function __construct(int $size, float $conflict_proportion = 0.2) {}

    /**
     * 内存表增加一列
     *
     * @param string $name
     * @param int    $type
     * @param int    $size
     * @author pf <576970513@qq.com>
     */
    public function column(string $name, int $type, int $size = 0) {}

    /**
     * 创建内存表
     *
     * @author pf <576970513@qq.com>
     */
    public function create() {}

    /**
     *设置行的数据，Table使用key-value的方式来访问数据
     *
     * @param string $key
     * @param array  $value
     * @author pf <576970513@qq.com>
     */
    public function set(string $key, array $value) {}

    /**
     * 原子自增操作
     *
     * @param string $key
     * @param string $column
     * @param int    $incrby
     * @author pf <576970513@qq.com>
     */
    public function incr(string $key, string $column, $incrby = 1) {}

    /**
     * 原子自减操作
     *
     * @param string $key
     * @param string $column
     * @param int    $decrby
     * @author pf <576970513@qq.com>
     */
    public function decr(string $key, string $column, $decrby = 1) {}

    /**
     * 获取一行的数据
     *
     * @param string      $key
     * @param string|null $field
     * @author pf <576970513@qq.com>
     * @return mixed
     */
    public function get(string $key, string $field = null) {}

    /**
     * 检查table中是否存在某一个key
     *
     * @param string $key
     * @author pf <576970513@qq.com>
     */
    public function exist(string $key) {}

    /**
     * 返回table中存在的条目数
     *
     * @author pf <576970513@qq.com>
     */
    public function count() {}

    /**
     * 删除数据
     *
     * @param string $key
     * @author pf <576970513@qq.com>
     */
    public function del(string $key) {}
}