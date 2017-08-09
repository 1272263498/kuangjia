<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2017/7/31
 * Time: 8:48
 */
//定义相对命名空间
namespace houdunwang\core;

//封装一个类Boot
class Boot{
//    创建一个静态类方法
    public static function run(){
//        调用初始化框架的静态方法
        self::init();
//        调用执行应用的静态方法
        self::appRun();

    }

    /**
     * 初始化
     */
    private static function init(){
//        开启session
        session_id() || session_start();
//        设置时区
        date_default_timezone_set('PRC');
//        定义是否是POST提交的常量
        define('IS_POST',$_SERVER['REQUEST_METHOD'] == 'POST' ? true : false);
    }
//        创建一个静态的执行应用方法
    private static function appRun(){
//        s=home/entry/index
//        用三元表达式判断是否获得s值，把获得的值转小写，没获得默认是‘home/entry/index’方法路径
        $s=isset($_GET['s']) ? strtolower($_GET['s']): 'home/entry/index';
//        1.利用字符串转数组函数，
//        2. 将文件目录路径以‘/’符号为字符节点转为数组元素便于组合类名、定义常量
        $arr = explode('/',$s);
//        p($arr);
//        Array
//		(
//			[0] => home
//			[1] => entry
//			[2] => index
//		)
//        1.把‘home’定义为常量，
//        2.在houdunwang/view/View.php文件里的View类的make方法组合模板路径，需要用的应用比如:home的名字
//		    home是默认应用，有可能为admin后台应用，所以不能写死home
        define('APP',$arr[0]);
//        1、把‘entry’定义为常量
//        2、在app/home/controller/Entry.php的完整的文件目录路径需要组合路径，entry.php文件是默认文件，有可能是后台应用文件，所以不可以写死；
        define('CONTROLLER',$arr[1]);
//        1、把数组$arr里面的下标2‘index’定义为常量
        define('ACTION',$arr[2]);
//        1.组合类名\app\home\controller\Entry
        $className = "\app\\{$arr[0]}\controller\\" . ucfirst($arr[1]);
//        调用控制器里面的方法
        echo call_user_func_array([new $className(),$arr[2]],[]);
    }

}