<?php
namespace core\model;


class Model{
    //定义链接数据库的变量属性
    protected static $config;
    public function __call($name, $arguments)
    {
        return self::paresAction($name,$arguments);
    }
    public static function __callStatic($name, $arguments)
    {
        return self::paresAction($name,$arguments);
    }
    public static function paresAction($name,$arguments){
        //用一个方法得到调用方法的类名称
        $info = get_called_class();
        //获取表名
        $table = strtolower(explode('\\',$info)[2]);
        //通过回调函数调用Base类里面的方法
       return call_user_func_array([new Base(self::$config,$table),$name],$arguments);
    }
    //接收链接数据库的配置项方法
    public function getConfig($config){
        //将当前的值赋给属性
        self::$config = $config;
    }


}