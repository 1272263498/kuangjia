<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2017/7/31
 * Time: 11:09
 */
//base类所在的空间名
namespace houdunwang\model;
//开启pdo所在的空间，完成操作数据库的一些操作
use PDO;
//开启PDOException所在的空间
use PDOException;

class Base{
    //保存PDO对象的静态属性
    private static $pdo = null;
//    实例化Base类时，自动执行此方法
    public function __construct() {
//        调用方法connect
        $this->connect();
    }

    /**
     * 链接数据库
     */
    private function connect() {
//          如果构造方法多次执行，那么此方法也会多次执行，用静态属性可以把对象保存起来不丢失；
//          第一次self::$pdo为null，那么就正常链接数据库；
//          第二次self::$pdo已经保存了pdo对象，不为NULL了，这样不用再次链接mysql了；
        if ( is_null( self::$pdo ) ) {
            try {
//                调用C函数引用c函数中的参数连接对应的数据库
                $dsn = 'mysql:host='.c('database.db_host').';dbname=' . c('database.db_name');
//                连接数据库
                $pdo = new PDO( $dsn, c('database.db_user'), c('database.db_password') );
//                设置错误方法为异常错误
                $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
//                将$pdo对象赋值给静态属性$pdo，表示已经连接了数据库防止重复连接
                $pdo->exec( "SET NAMES " . c('database.db_charset') );
                //把PDO对象放入到静态属性中
                self::$pdo = $pdo;
            } catch ( PDOException $e ) {
//                输出抓获的异常错误并中断后面的代码
                exit( $e->getMessage() );
            }
        }

    }

    /*
     * 获取全部数据
     */
//    创建一个get方法用来获取对应表的所有数据
    public function get( $table ) {
//        获得数据库里的数据
        $sql    = "SELECT * FROM {$table}";
//        通过有结果集的操作执行sql语句完成获取对应表的数据
        $result = self::$pdo->query( $sql );
        //获得关联数组
        $data = $result->fetchAll( PDO::FETCH_ASSOC );
//        将转好的数据返回给当前的对象
        return $data;
    }

    /**
     * 执行有结果集的操作
     *
     * @param $sql
     */
//    创建一个q方法用来执行一些有结果集的sql语句，并将获取的数据返回给当前对象
    public function q( $sql ) {
//        将错误信息转换成异常错误，因为只有异常错误才能捕获
        try {
//            通过有结果集的操作执行传递过来的sql语句，并将获取的结果赋值给$result
            $result = self::$pdo->query( $sql );
//            将获取的结果转换成关联数组返回给当前对象
            return $result->fetchAll( PDO::FETCH_ASSOC );
        } catch ( PDOException $e ) {//捕获PDO异常错误 $e 是异常对象
//            输出捕获的错误信息并中断代码执行
            exit( "SQL错误：" . $e->getMessage() );
        }
    }

    /**
     * 执行没有结果集的操作
     *
     * @param $sql
     */
//    创建一个e方法用来执行一些没有结果集的sql语句，并将获取的数据返回给当前对象
    public function e( $sql ) {
//        将错误信息转换成异常错误，因为只有异常错误才能捕获
        try {
//            通过没有结果集的操作执行传递过来的sql语句，并将执行完获取的结果赋值给$afRows
            $afRows = self::$pdo->exec( $sql );
//            将获取的结果返回给当前对象
            return $afRows;
        } catch ( PDOException $e ) {//捕获PDO异常错误 $e 是异常对象
            exit( "SQL错误：" . $e->getMessage() );
        }
    }

}