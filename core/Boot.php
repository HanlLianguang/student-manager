<?php
namespace core;
//管家类

class Boot{
public function run(){
    //开启session
    session_start();
    //首先分析get参数里面有没有带s参数，如果带了就用用户传的，如果没有那就要设置默认值
    if (isset($_GET['s'])){
        //如果用户传了参数就将s 参数切割成数组
        $info = explode('/',$_GET['s']);
        //定义模块的变量
        $m = $info[0];
        //定义控制器的变量
        $c = ucfirst($info[1]);
        //定义方法的变量
        $a = $info[2];
    }else{
        //用户没有传递s参数的时候就设置默认的模块、控制器、方法
        //默认的模块
        $m = 'home';
        //默认的控制器
        $c = 'Entry';
        //默认的方法
        $a = 'index';
    }
    //定义模块、控制器、方法的常量
    //模块的常量
    define('MODULE',$m);
    //控制器的常量
    define('CONTROLLER',$c);
    //方法的常量
    define('ACTION',$a);
    //组合需要的类的名称
    $class = '\app\\'.$m. '\\controller\\'.$c;
    //使用回调函数找到需要的模块的控制器的方法并输出
    echo call_user_func_array([new $class,$a],[]);
}
}