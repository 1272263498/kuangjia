<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2017/7/31
 * Time: 10:48
 */
//定义相对路径的命名空间
namespace houdunwang\core;

//创建一个类，让entry来继承着各类里面的方法
class Controller{
//    定义一个私有属性用来传递地址，默认是返回地址
    private $url = 'window.history.back()';
//    定义一个私有的变量属性，用来保存地址
    private $template;
//    定义一个私有属性，用来传递提示语句
    private $msg;

    /**
     * 跳转
     * @param $url
     *
     * @return $this
     */
//    1.定义一个受保护的跳转方法，只有这个类和类的子集可以使用；
//    2.把要跳转的地址用参数方式传入这个方法
    protected function setRedirect($url){
//        调用私有属性保存跳转地址；
        $this->url = "location.href='{$url}'";
//        把这个地址当作一个对象反给boot类输出；
        return $this;
    }

    /**
     * 成功的时候
     * @param $msg
     * @return $this
     */
//    1.定义一个受保护的成功时候页面显示的方法，只有这个类和类的子集可以使用；
//    2.把要显示的页面的地址用参数方式传入这个方法
    protected function success($msg){
//        调用定义的私有属性来保存显示页面的地址
        $this->msg = $msg;
//        调用私有属性$template存储一个提示语句的php文件
        $this->template = './view/success.php';
//        返回当前对象到boot
        return $this;
    }

    /**
     * 失败的时候
     */
    protected function error($msg){
        $this->msg = $msg;
        $this->template = './view/error.php';
        return $this;
    }

    public function __toString() {
        include $this->template;
        return '';
    }


}