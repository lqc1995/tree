English | [简体中文](/README.zh-CN.md)

## Intro
```
This is a concise directory tree class.
```

## Install
```
composer require handsome/tree
```

## Result
```
|-dir1
    |-dir2
        |-dir3
            |-xxx.txt
            |-xxx.txt
            |-xxx.txt
    |-dir2
    |-dir2
|-dir1
|-dir1
```

## Example
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
