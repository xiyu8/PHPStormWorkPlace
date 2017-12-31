<?php
/**
 * Created by PhpStorm.
 * User: 晞余
 * Date: 2017/4/23
 * Time: 11:28
 */




//////////////////////////////////////Post Get 兼容程序/////////////////////////////////////////////////
if(isset($_GET['userId']))  $userId=$_GET['userId'];
if(isset($_GET['colorfulWallContent']))  $colorfulWallContent=$_GET['colorfulWallContent'];
if(isset($_GET['colorfulWallPic']))  $colorfulWallPic=$_GET['colorfulWallPic'];


if(isset($POST['userId']))  $userId=$POST['userId'];
if(isset($POST['colorfulWallContent']))  $colorfulWallContent=$POST['colorfulWallContent'];
if(isset($POST['colorfulWallPic']))  $colorfulWallPic=$POST['colorfulWallPic'];
echo "uuuu".$goodName.$userId.$colorfulWallContent;
///////////////////////////////////////////////////////////////////////////////////////

$servername = "localhost";
$dbname = "openjcu";
$username = "root";
$password = "12345";

$pdo=new PDO("mysql:host=localhost;dbname=openjcu","root","12345");
$pdo->query('set names utf8');


/*
 * 插入数据
 */
$rt=1;
if($rt==0){
    //代表用户名重复
    echo '用户信息错误';
} else if($rt==1) {

    if(isset($_GET['colorfulWallPic']) || isset($_POST['colorfulWallPic'])) {
        try {
            // 设置 PDO 错误模式，用于抛出异常
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $insertCmd = "insert into colorfulwall(colorfulWallPic,colorfulWallContent,userId) value('$colorfulWallPic','$colorfulWallContent','$userId')";
            $pdo->exec($insertCmd);

            $result = $pdo->query("select colorfulWallId from colorfulwall ORDER by memoCreatTime DESC limit 1");
            //$result2->setFetchMode(PDO::FETCH_OBJ);
            $result->setFetchMode(0);
            $jg = $result->fetch();
            $id = $jg[0];//表中记录的条数  strlen($count)

            echo "新记录插入成功,$id";
        } catch (PDOException $e) {
            /**
             * 插入数据异常
             */
            echo $e->getMessage();
        }
    }else{
        try {
            // 设置 PDO 错误模式，用于抛出异常
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $insertCmd = "insert into colorfulwall(colorfulWallContent,userId) value('$colorfulWallContent','$userId')";
            $pdo->exec($insertCmd);

            $result = $pdo->query("select colorfulWallId from colorfulwall ORDER by memoCreatTime DESC limit 1");
            //$result2->setFetchMode(PDO::FETCH_OBJ);
            $result->setFetchMode(0);
            $jg = $result->fetch();
            $id = $jg[0];//表中记录的条数  strlen($count)

            echo "新记录插入成功,$id";
        } catch (PDOException $e) {
            /**
             * 插入数据异常
             */
            echo $insertCmd . "<br>" . $e->getMessage();
        }
    }






}
$pdo = null;
?>