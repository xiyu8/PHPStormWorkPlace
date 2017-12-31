<?php
/**
 * Created by PhpStorm.
 * User: 晞余
 * Date: 2017/4/15
 * Time: 15:33
 */





$groupName=$_GET['groupName'];

$IMME=$_GET['IMME'];

$cmd="delete from member where memberId='$IMME' && groupId='$groupName'";
$pdo=new PDO("mysql:host=localhost;dbname=openjcu","root","12345");
$pdo->query('set names utf8');

$result=$pdo->exec($cmd);
echo "退出成功".$result;

?>