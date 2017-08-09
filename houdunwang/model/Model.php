<?php
//定义一个模型的相对命名空间
namespace houdunwang\model;

//创建一个模型类model
class Model {
//    定义一个调用一个未找到的静态的类，执行此方法
    public static function __callStatic( $name, $arguments ) {
//
        return call_user_func_array([new Base(),$name],$arguments);
    }
}