<?php
/**
 * 打印函数
 * @param $var
 */
//原样输出p函数
function p($var){
    echo '<pre style="background: #ccc;padding: 10px;border-radius: 5px;">';
    print_r($var);
    echo '</pre>';
}

//用c函数调用数据库
function c($path){
//    字符串转数组
    $arr = explode('.',$path);
//    组合载入php文件目录路径
    $config = include '../system/config/' . $arr[0] . '.php';
//    把组合好的路径返出去
    return isset($config[$arr[1]]) ? $config[$arr[1]] : NULL;
}
