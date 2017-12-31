<?php
/**
 * Created by PhpStorm.
 * User: 晞余
 * Date: 2017/4/20
 * Time: 14:37
 */
$groupId = $_GET['groupId'];
if(isset($_GET['chatItemDate'])){
    $chatItemDate = $_GET['chatItemDate'];
}else{
    $chatItemDate = "2017-04-11 20:20:20";
}

$cmd="select * from member join chatitem on member.memberId=chatitem.memberId  where groupId='$groupId' && chatItemDate>'$chatItemDate' ORDER by chatItemDate DESC";


$rel = array();
$pdo=new PDO("mysql:host=localhost;dbname=openjcu","root","12345");
$pdo->query('set names utf8');
//select * from primetheme join user on primetheme.userId=user.id;
$result=$pdo->query($cmd);
$result->setFetchMode(PDO::FETCH_OBJ);
//echo $result->rowCount();  记录条数
//$result->setFetchMode(0);
$i=0;

//if($result->rowCount()==0){     //判断查询结果 记录的条数
//    echo "无记录";
//}else {
    while ($jg = $result->fetch()) {
        $rel[$i] = $jg;
        $i++;
    }

//echo  $rel[0]->id;
    echo json_encode($rel);
//json_decode
//}

?>