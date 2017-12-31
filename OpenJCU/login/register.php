<?php
/**
 * Created by PhpStorm.
 * User: 晞余
 * Date: 2017/3/21
 * Time: 16:58
 */


/**
 * 查询表中记录条数
 */
//$pdo=new PDO("mysql:host=localhost;dbname=openjcu","root","12345");
//$pdo->query('set names utf8');
//$result=$pdo->query('SELECT count(name) from user');
////$result2->setFetchMode(PDO::FETCH_OBJ);
//$result->setFetchMode(0);
//$jg= $result->fetch();
//$count=$jg[0][0];     //表中记录的条数
//
//echo  $count;


/**
 * 插入数据
 */
//$servername = "localhost";
//$dbname = "openjcu";
//$username = "root";
//$password = "12345";
//
//try {
//    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
//    // 设置 PDO 错误模式，用于抛出异常
//    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    $insertCmd = "INSERT INTO user (name, pwd) VALUES ('John', 'Doe')";
//    // 使用 exec() ，没有结果返回
//    $pdo->exec($insertCmd);
//    echo "新记录插入成功";
//}
//catch(PDOException $e)
//{
//    echo $insertCmd . "<br>" . $e->getMessage();
//}
//
//$pdo = null;

/**
 * 查询有无对应条件的用户，并返回id  注意query中 name=‘$name’
 *

 *
 */
//$rel = array();
//$pdo=new PDO("mysql:host=localhost;dbname=openjcu","root","12345");
//$pdo->query('set names utf8');
//$result=$pdo->query('select * from user where name=\'xiyu\' && pwd=\'12345\'');
//$result->setFetchMode(PDO::FETCH_OBJ);
////$result->setFetchMode(0);
//$i=0;
//while ($jg = $result->fetch()) {
//    $rel[$i] = $jg;
//    $i++;
//}     //表中记录的条数
//
//echo  $rel[0]->id;




/*
 * 验证注册。
 *
 * 参数：$_GET['username']、$_GET['pwd']
 * 返回值：数据表中已存在此用户  1、'用户名已存在'
 *                              2、"新记录插入成功"
 *                              3、长度大于20的异常字符串
 */
$servername = "localhost";
$dbname = "openjcu";
$username = "root";
$password = "12345";

$name=$_GET['username'];
$pwd=$_GET['pwd'];

$rt;


$pdo=new PDO("mysql:host=localhost;dbname=openjcu","root","12345");
$pdo->query('set names utf8');
$result=$pdo->query("select count(userName) from user where userName='$name' && pwd='$pwd' ");
//$result2->setFetchMode(PDO::FETCH_OBJ);
$result->setFetchMode(0);
$jg= $result->fetch();
$count=$jg[0][0];//表中记录的条数  strlen($count)
if($count==1){
       //代表用户名重复
    echo '用户名已存在';
} else {
    try {
        // 设置 PDO 错误模式，用于抛出异常
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $insertCmd = "INSERT INTO user (userName, pwd) VALUES ('$name' , '$pwd')";
        // 使用 exec() ，没有结果返回
        $pdo->exec($insertCmd);


        $result = $pdo->query("select userId from user where userName='$name' && pwd='$pwd'");
        //$result2->setFetchMode(PDO::FETCH_OBJ);
        $result->setFetchMode(0);
        $jg = $result->fetch();
        $userId = $jg[0];//表中记录的条数  strlen($count)
        echo '新记录插入成功,'.$userId;

    }
    catch(PDOException $e)
    {
        /**
         * 插入数据异常
         */
        echo $insertCmd . "<br>" . $e->getMessage();
    }
}
$pdo = null;


?>