<?php
/**
 * Created by PhpStorm.
 * User: 晞余
 * Date: 2017/4/20
 * Time: 14:37
 */

$memberId = $_GET['memberId'];
$chatContent = $_GET['chatContent'];

$cmd = "insert into chatitem(chatContent,memberId) VALUE('$chatContent','$memberId')";








//
//try {
//    // 设置 PDO 错误模式，用于抛出异常
//    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    $insertCmd = "insert into comment(commentContent,themeId,userId,commentPics) value('$content','$themeid','$id','$commentPics')";
//    $pdo->exec($insertCmd);
//
//
//    $result = $pdo->query("select commentId from comment ORDER by commentTime DESC limit 1");
//    //$result2->setFetchMode(PDO::FETCH_OBJ);
//    $result->setFetchMode(0);
//    $jg = $result->fetch();
//    $commentId = $jg[0];//表中记录的条数  strlen($count)
//    echo "新记录插入成功,".$commentId;
//} catch(PDOException $e) {//插入数据异常
//    echo $insertCmd . "<br>" . $e->getMessage();
//}


try {
    $pdo = new PDO("mysql:host=localhost;dbname=openjcu", "root", "12345");

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->query('set names utf8');

    $result = $pdo->exec($cmd);


    echo "加入成功".$result;
}
catch(PDOException $e) {//插入数据异常
    echo $cmd . "<br>" . $e->getMessage();
}
?>