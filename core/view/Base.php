<?php
namespace core\view;


class Base{
    //定义模板路径的属性
    protected $file;
    //定义模板变量的属性
    protected $vars = [];

    public function make(){
        //定义需要加载的模板路径
        $this->file = 'app/'.MODULE.'/view/'.strtolower(CONTROLLER).'/'.ACTION.'.php';
        //返回当前对象
        return $this;
//        echo '<pre>';
//        print_r($this);die;
    }
    //分配变量的方法
    public function with($name,$value){
        //$name当做主键名$value做主键值
        $this->vars[$name] = $value;
        //将值返回
        return $this;
    }

    public function __toString(){
       //处理模板变量
        extract($this->vars);
        //加载对应的模板
        include $this->file;
        //因为当前魔术方法必须返回一个值，但是这里除了模板没有其他的，所以返回一个空的字符串
        return '';
    }


}