<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4918b2cf9540127e9523f8e5aaf604e1
{
    public static $files = array (
        '3332ecb830ac8801d945afa9ec679833' => __DIR__ . '/../..' . '/houdunwang/core/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'h' => 
        array (
            'houdunwang\\' => 11,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'houdunwang\\' => 
        array (
            0 => __DIR__ . '/../..' . '/houdunwang',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4918b2cf9540127e9523f8e5aaf604e1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4918b2cf9540127e9523f8e5aaf604e1::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
