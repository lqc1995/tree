[English](README.md) | 简体中文

## 简介
```
这是一个简洁的目录树类。
```

## 安装
```
composer require handsome/tree
```

## 效果
```
|-一级
    |-二级
        |-三级
            |-xxx.txt
            |-xxx.txt
            |-xxx.txt
    |-二级
    |-二级
|-一级
|-一级
```

## 例子
```php
<?php
require './vendor/autoload.php';

use Tree\Tree;

$obj = new Tree();
$arr = [
    [
        'id' => '1',
        'catname' => 'PHP图书',
        'pid' => '0',
        'ord' => '1'
    ],
    [
        'id' => '2',
        'catname' => 'JAVA图书',
        'pid' => '0',
        'ord' => '2'
    ],
    [
        'id' => '3',
        'catname' => 'Python图书',
        'pid' => '0',
        'ord' => '3'
    ],
    [
        'id' => '4',
        'catname' => 'PHP初级',
        'pid' => '1',
        'ord' => '1'
    ],
    [
        'id' => '5',
        'catname' => 'PHP中级',
        'pid' => '1',
        'ord' => '2'
    ],
    [
        'id' => '6',
        'catname' => 'PHP高级',
        'pid' => '1',
        'ord' => '3'
    ],
    [
        'id' => '7',
        'catname' => '细说PHP',
        'pid' => '4',
        'ord' => '1'
    ]
];
//$tree_list = $obj::getList($arr);
$tree_list = $obj::getTree($arr);
print_r($tree_list);

```
