<?php
/**
 * Created by PhpStorm.
 * User: 晞余
 * Date: 2017/4/15
 * Time: 20:49
 */


$position=$_GET['position'];
$IMME=$_GET['IMME'];
$groupName=$_GET['groupName'];

$cmd1="select * from member where memberId='$IMME'";  //判断是否已被删除
$cmd2="UPDATE member SET memberPosition='$position' WHERE memberId='$IMME'";
$cmd3="select * from member where groupId='$groupName'";

$rel = array();

$pdo=new PDO("mysql:host=localhost;dbname=openjcu","root","12345");
$pdo->query('set names utf8');
$result=$pdo->query($cmd1);
$result->setFetchMode(PDO::FETCH_OBJ);
$flag=$result->rowCount();
if($flag==0){
    echo '小分队已被删除';
}else{
    $result=$pdo->exec($cmd2);
//    if($result!=1){
//        echo "出错";
//    }else {
        $result = $pdo->query($cmd3);
        $i=0;
        while ($jg = $result->fetch()) {
            $rel[$i] = $jg;
            $i++;
        }
        echo json_encode($rel);
//    }
}








?>