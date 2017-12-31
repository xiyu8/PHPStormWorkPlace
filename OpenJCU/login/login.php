<?php
/**
 * Created by PhpStorm.
 * User: 晞余
 * Date: 2017/3/21
 * Time: 19:06
 */

/**
 * 查询有无对应条件的用户:
 *
 * 参数：$_GET['username']、$_GET['pwd'];
 * 返回值：1，用户id
 *         2，长度大于20的异常字符串
 *
 * 并返回id
 * 没有则返回一个长度大于20的异常字符串
 */


$name=$_GET['username'];
$pwd=$_GET['pwd'];
$rel = array();
$pdo=new PDO("mysql:host=localhost;dbname=openjcu","root","12345");
$pdo->query('set names utf8');
$result=$pdo->query("select * from user where userName='$name' && pwd='$pwd' ");
$result->setFetchMode(PDO::FETCH_OBJ);
//$result->setFetchMode(0);
$i=0;
while ($jg = $result->fetch()) {
    $rel[$i] = $jg;
    $i++;
}     //表中记录的条数

echo  $rel[0]->userId;

?>