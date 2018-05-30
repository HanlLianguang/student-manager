<?php
namespace app\admin\controller;

use core\Controller;
use core\view\View;
use system\model\User;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
class Login extends Controller {
    public function loginForm(){
        //首先判断是否是post数据提交
        if ($_POST){
            //获得post数据
            $post = $_POST;
            //判断验证码是否输入正确
            if ($post['code'] != $_SESSION['code']){
                return $this->redirect()->message('验证码输入错误');
            }


            //判断数据库中是否存在当前输入的用户名和密码的数据,如果存在,继续往下执行,如果不存在,提示并返回
            $userInfo = User::where('username = "'.$post['username'].'" and password = "' . md5($post['password']) . '"')->get()->toArray();

            if (empty($userInfo)){
                return $this->redirect()->message('用户名或密码输入错误!!!');
            }
            if (isset($post['autologin'])){
                setcookie(session_name(),session_id(),time() + 7*24*3600,'/');
            }
            //登录成功,将用户的用户名和数据库中的用户id存入session中
            $_SESSION['username'] = $post['username'];
            $_SESSION['uid'] = $userInfo[0]['id'];
            //提示登录成功,并跳转去指定的后台首页

            return $this->redirect('index.php?s=admin/Entry/index')->message('恭喜你,登录成功');

        }
        //加载登录模板
        return View::make();
        }
    public function logout(){
        //清除session内容
        session_unset();
        session_destroy();
        //跳转去后台登录
        return $this->redirect('index.php?s=admin/login/loginForm')->message('退出成功');
    }

     //生成验证码的方法
    public function code(){
        $phraseBuilder = new PhraseBuilder(4,'1234567890');
        $builder = new CaptchaBuilder(null, $phraseBuilder);
        $builder->build();
        header('Content-type: image/jpeg');
        $builder->output();
        //将生成的验证码存入session
        $_SESSION['code'] = $builder->getPhrase();
    }

}