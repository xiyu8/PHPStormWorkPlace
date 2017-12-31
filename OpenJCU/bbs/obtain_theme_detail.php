<?php
/**
 * Created by PhpStorm.
 * User: 晞余
 * Date: 2017/3/22
 * Time: 20:06
 */
/*
 * 获取theme详细
 * 获取comment详细
 *
 * 参数: themeid $_GET['id']
 * 返回值：对应themeId的comment的，对象数组
 *          “无记录”
 */
$themeId=$_GET['id'];
$rps;  //返回值

$rel = array();
$pdo=new PDO("mysql:host=localhost;dbname=openjcu","root","12345");
$pdo->query('set names utf8');
$result=$pdo->query("select * from comment join user on comment.userId=user.userId where themeId='$themeId'");
$result->setFetchMode(PDO::FETCH_OBJ);
//echo $result->rowCount();  记录条数
//$result->setFetchMode(0);

if($result->rowCount()==0){
    echo "无记录";
}else {
    $i=0;
    while ($jg = $result->fetch()) {
        $rel[$i] = $jg;
        $i++;
    }

//echo  $rel[0]->id;
    echo json_encode($rel);
//json_decode
}


?>