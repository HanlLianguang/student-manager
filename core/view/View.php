<?php
namespace core\view;


class View{
//调用类的时候，找不到的时候调用
    public function __call($name, $arguments)
    {
        return self::paraeAction($name, $arguments);
    }

//静态调用的时候找不到的时候执行
    public static function __callStatic($name, $arguments)
    {
        return self::paraeAction($name, $arguments);
    }

    public static function paraeAction($name,$arguments){
        //用回调函数找到需要的那个模块的类的方法
        return call_user_func_array([new Base(),$name],$arguments);
    }
}