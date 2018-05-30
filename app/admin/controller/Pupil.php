<?php
namespace app\admin\controller;
use system\model\Pupil as p;
use core\view\View;
use system\model\Grade;
class Pupil extends Common {
    //学生管理列表
    public function index(){
        //获得所有的学生数据，调用query方法，首先自己组建sql语句
        $sql = "select p.*,g.class as gname from pupil as p join grade as g on p.class = g.id;";
        //调用query方法执行sql语句
        $pupil =p::query($sql)->toArray();
    //加载模板
     return View::make()->with('pupil',$pupil);
    }

    //学生添加方法
    public function create(){
        if ($_POST){
            //获得post数据
            $post = $_POST;
            //使用框架你的add方法进行添加数据
            $result = p::add($post);
            //判断result是否为真,为真则添加成功，为假则添加失败
            if ($result){
                return $this->redirect('index.php?s=admin/pupil/index')->message('数据添加成功');
            }else{
                return $this->redirect()->message('数据添加失败');
            }
        }
        //获得所有的班级数据
        $grade = Grade::get()->toArray();
        //加载添加学生模板
        return View::make()->with('grade',$grade);
    }
    //学生编辑方法
    public function edit(){
        //获取所有班级数据并分配
        $grade = Grade::get()->toArray();
        //获得需要修改的学生id
        $id = $_GET['id'];
        //通过对应的id找到对应的学生数据
        $pupil = p::find($id)->toArray();

        //判断是否为post数据
        if ($_POST){
            //获得post数据
            $post = $_POST;
            //调用框架的edit方法来编辑数据
            $result = p::edit($post);
            //判断result是否为真,为真则修改成功，为假则修改失败
             if ($result){
                return $this->redirect('index.php?s=admin/pupil/index')->message('数据修改成功');
            }else{
                return $this->redirect()->message('数据修改失败');
            }
        }
        //加载学生编辑模板，分配学生修改的数据
        return View::make()->with('grade',$grade)->with('pupil',$pupil);
    }
    //删除方法
    public function delete(){
        //获取学生列表中需要删除的学生id
        $id = $_GET['id'];
        //调用框架里面的删除方法进行删除
        $result = p::delete($id);
        //判断result是否为真,为真则删除成功，为假则删除失败
             if ($result){
                 return $this->redirect('index.php?s=admin/pupil/index')->message('数据删除成功');
             }else{
                 return $this->redirect()->message('数据删除失败');
             }




    }



}

?>
