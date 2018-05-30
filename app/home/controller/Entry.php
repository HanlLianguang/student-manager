<?php
namespace app\home\controller;

//默认的控制器
use core\view\View;

class Entry {
 public function index(){
     //返回一个版本号
     return View::make()->with('version','版本:v1.0');
 }
}