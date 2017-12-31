<?php
/**
 * Created by PhpStorm.
 * User: 晞余
 * Date: 2017/4/15
 * Time: 15:33
 */


$groupName = $_GET['groupName'];
$IMME=$_GET['IMME'];
$position = $_GET['position'];

$cmd1="select * from MyGroup WHERE groupId='$groupName'";
$cmd2="insert into member(memberId,memberPosition,groupId) value('$IMME','$position','$groupName')";

$pdo=new PDO("mysql:host=localhost;dbname=openjcu","root","12345");
$pdo->query('set names utf8');


$result=$pdo->query($cmd1);
$result->setFetchMode(PDO::FETCH_OBJ);
$cc=$result->rowCount();
if($cc!=1){
    echo "小分队不存在";
}else{
    $result=$pdo->exec($cmd2);
    echo "加入成功";
}


//



?>