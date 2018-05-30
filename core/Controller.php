<?php
namespace core;


class Controller{
    //定义默认的跳转属性
    protected $url = 'location.href = window.history.back()';
    //操作成功或失败的方法
    public function redirect($url=''){
        //如果用户传递了跳转地址，就跳转用户传的地址，如果没有就默认返回上一层
        //判断用户有没有传递$url参数，有就跳转用户指定的地址，没有就设置默认值
        if($url != ''){
            //将用户传递的值赋给属性
            $this->url = "location.href = '" .$url ."'";
        }
        //将值返回
        return $this;
    }
    //操作成功或者失败的跳转方法
    public function message($msg){
        include 'public/view/message.php';
    }

}