<?php
/**
 * Created by PhpStorm.
 * User: 27376
 * Date: 2020/4/15
 * Time: 12:16
 */

namespace Tree;

class Tree
{
    private static $order = 'ord'; // 有排序字段和表的对应
    private static $id = 'id'; // 表的id字段
    private static $pid = 'pid'; // 表的父级pid字段
    private static $son = 'subcat'; // 如果有子数组，子数组下标，可以自定义值
    private static $level = 'level'; // 默认的新加级别下标，可以自定义值
    private static $path = 'path'; // 默认的路径下标，可以自定义
    private static $ps = ','; // 默认的路径分隔符号，可以自己定义
    private static $childs = 'childs'; // 默认的子数组下标，可以自己定义
    private static $i; // 临时的一个标记
    private static $narr = array(); // 放分完级别后的数组

    /**
     * 获取分类结构
     * @param $items
     * @return array|void
     */
    public static function getTree($items)
    {
        if (empty($items)) return [];
        $tree = []; // 格式化的树
        $tmpMap = []; // 临时扁平数据

        foreach ($items as $item) {

            // 如果数组中有排序字段则先排序
            if(array_key_exists(self::$order, $item)) {
                usort($items, [__CLASS__, 'compare']);
            }
            $tmpMap[$item[self::$id]] = $item;
        }

        foreach ($items as $item) {
            if (isset($tmpMap[$item[self::$pid]])) {

                // 子级（无ord排序）
                $tmpMap[$item[self::$pid]][self::$son][] = &$tmpMap[$item[self::$id]];
            } else {

                // 顶级（有ord排序）
                $tree[] = &$tmpMap[$item[self::$id]];
            }
        }

        return self::path_child($tree);
    }

    /**
     * 设置类路径，和获取全部子类
     * @param $arr
     * @param string $path
     * @return array
     */
    private static function path_child($arr, $path = '')
    {
        $x_arr = [];
        foreach ($arr as $k => $v) {
//            echo ($k);
            if (!is_numeric($k)) {
//                print_r($arr);exit;
            } else {
//                print_r($arr);exit;
            }
            $x_arr[$k] = $v;
            $x_arr[$k][self::$path] = $path.self::$ps.$v[self::$pid];
            $x_arr[$k][self::$childs] = '';

            if (isset($x_arr[$k][self::$son])) {
                $x_arr[$k][self::$son] = self::path_child($x_arr[$k][self::$son], $x_arr[$k][self::$path]);

                foreach ($x_arr[$k][self::$son] as &$vv) {
                    trim($vv[self::$path], ',');
                    $x_arr[$k][self::$childs] .= $vv[self::$id];
                    $x_arr[$k][self::$childs] .= self::$ps . $vv[self::$childs];
                }
            }
        }

        return $x_arr;
    }

    /**
     * 返回带有层数级别的二维数组
     * @param $arr
     * @return array
     */
    public static function getList($arr)
    {
        return self::c_level(self::getTree($arr));
    }

    /**
     * 转多层数组为二维数组，并加上层数组别
     * @param $arr
     * @param int $num
     * @return array
     */
    private static function c_level($arr, $num = 0)
    {
        self::$i = $num;
        foreach ($arr as $v) {
            if (isset($v[self::$son])) {
                $v[self::$level] = self::$i++;
                $subcat = $v[self::$son];
                unset($v[self::$son]);
                $v[self::$childs] = trim($v[self::$childs], self::$ps);
                $v[self::$path] = trim($v[self::$path], self::$ps);
                self::$narr[$v[self::$id]] = $v;
                self::c_level($subcat, self::$i);
            } else {
                $v[self::$level] = self::$i;
                $v[self::$childs] = trim($v[self::$childs], self::$ps);
                $v[self::$path] = trim($v[self::$path], self::$ps);
                self::$narr[$v[self::$id]] = $v;
            }
        }
        self::$i--;

        return self::$narr;
    }

    /**
     * 内部使用方法，将按二维数组中的指定排序字段排序
     * @param $x
     * @param $y
     * @return int
     */
    private static function compare($x, $y)
    {
        if ($x[self::$order] == $y[self::$order]) return 0;
        elseif ($x[self::$order] < $y[self::$order]) return -1;
        else return 1;
    }
}