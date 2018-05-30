<?php
//设置链接的数据库
$config = [
    //数据源
    'host' => 'localhost',
    //表名
    'dbname'=>'student',
    //用户名
    'username' => 'root',
    //密码
    'password' => 'root'
    ];

(new \core\model\Model())->getConfig($config);