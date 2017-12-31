<?php
/**
 * Created by PhpStorm.
 * User: 晞余
 * Date: 2017/3/22
 * Time: 20:13
 */

/*
 * 验证用户是否存在。
 *
 * 参数：$_GET['username']、$_GET['pwd']
 * 返回值：1、'验证用户正确'
 *         2、'无此用户'
 *          3、'异常'
 *
 */
$servername = "localhost";
$dbname = "openjcu";
$username = "root";
$password = "12345";

$name=$_GET['username'];
$pwd=$_GET['pwd'];

$pdo=new PDO("mysql:host=localhost;dbname=openjcu","root","12345");
$pdo->query('set names utf8');
try {
    $result = $pdo->query("select userId from user where userName='$name' && pwd='$pwd' ");
    //$result2->setFetchMode(PDO::FETCH_OBJ);
    $result->setFetchMode(0);
    $count=$result->rowCount();
    $jg = $result->fetch();
    $userId = $jg[0];//表中记录的条数  strlen($count)
    if ($count == 1) {
            echo '验证用户正确,'.$userId;
    } else {
            echo "无此用户";
    }


} catch (PDOException $e){
    echo '异常';

}

$pdo = null;
?>