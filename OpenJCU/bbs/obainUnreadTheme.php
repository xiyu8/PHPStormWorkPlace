<?php
/**
 * Created by PhpStorm.
 * User: 晞余
 * Date: 2017/4/8
 * Time: 15:31
 */

$userId=$_POST['userId'];

$rel = array();
$pdo=new PDO("mysql:host=localhost;dbname=openjcu","root","12345");
$pdo->query('set names utf8');
$result=$pdo->query("select * from theme where userId='$userId'");
$result->setFetchMode(PDO::FETCH_OBJ);
$allTheme=$result->rowCount();  //所有记录条数
//$result->setFetchMode(0);


$result=$pdo->query("select * from theme where themeId='$themeId'");
$result->setFetchMode(PDO::FETCH_OBJ);
$readComment=$result->readCommentQuantity;   //已读记录条数

$unreadCommentQuantity=$allComment-$readComment;

echo "{\"unreadCommentQuantity\":\"$unreadCommentQuantity\"";



?>