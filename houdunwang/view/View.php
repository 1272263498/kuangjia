<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2017/7/31
 * Time: 11:26
 */

namespace houdunwang\view;


class View{

    public static function __callStatic( $name, $arguments ) {
        return call_user_func_array([new Base(),$name],$arguments);
    }
}