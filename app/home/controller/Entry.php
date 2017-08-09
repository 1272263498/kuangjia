<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2017/7/31
 * Time: 10:02
 */
//相对命名空间
namespace app\home\controller;
//导入命名空间里面的类Controller
use houdunwang\core\Controller;
//导入命名空间里面的类View
use houdunwang\view\View;
//导入命名空间里面的类Model
use houdunwang\model\Model;

class Entry extends Controller{
        /**
         * 默认首页
         */
//    创建一个显示首页的方法
    public function index(){
//        用Model类里面的执行结果集q方法查询arc表，再把获得的数组存起来
        $data=Model::q("SELECT * FROM arc");
//        把变量名变为键名，变量值变为键值然后传给View里的with;
//        把结果返给boot
        return View::with(compact('data'))->make();
    }

    /**
     * 添加
     */
    public function add(){
//        如果用户点击了添加按钮
        if(IS_POST){
//            向数据库里插入一条新的数据
            $sql="INSERT INTO arc (title) VALUES ('{$_POST['title']}')";
//            用Model的静态语句e方法执行无结果集的方法
            Model::e($sql);
//          操作成功是先跳出成功提示，再返回到主页面，把这些操作都返给boot输出
            return $this->success('添加成功')->setRedirect('index.php');
        }
//        向boot返回这个添加模版并输出
        return View::make();
    }

    /**
     * 删除
     */
    public function remove(){
//        获得点击要删除的数据的aid
        $sql = "DELETE FROM arc WHERE aid=" . $_GET['aid'];
//        调用静态Model类，传参给执行没有结果集的方法
        Model::e($sql);
//        把操作成功提示方法返回到boot里，再输出
        return $this->success('删除成功');
    }




}