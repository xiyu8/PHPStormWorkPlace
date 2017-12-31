<?php

/*
 * 参数：$_GET['username']、$_GET['pwd']、$_GET['title']、$_GET['content']、$_GET['category']
 * 返回值：新记录插入成功
 */

/**
 * Created by PhpStorm.
 * User: 晞余
 * Date: 2017/3/22
 * Time: 20:04
 */


//////////////////////////////////////Post Get 兼容程序/////////////////////////////////////////////////
if(isset($_GET['username']))  $name=$_GET['username'];
if(isset($_GET['pwd']))  $pwd=$_GET['pwd'];
if(isset($_GET['title']))  $title=$_GET['title'];
if(isset($_GET['content']))  $content=$_GET['content'];
if(isset($_GET['category']))  $category=$_GET['category'];
if(isset($_GET['themePics']))  $themePics=$_GET['themePics'];

if(isset($POST['username']))  $name=$POST['username'];
if(isset($POST['pwd']))  $pwd=$POST['pwd'];
if(isset($POST['title']))  $title=$POST['title'];
if(isset($POST['content']))  $content=$POST['content'];
if(isset($POST['category']))  $category=$POST['category'];
if(isset($POST['themePics']))  $themePics=$POST['themePics'];

///////////////////////////////////////////////////////////////////////////////////////

$servername = "localhost";
$dbname = "openjcu";
$username = "root";
$password = "12345";
/**
 * 验证用户信息
 *
 */
$rt;
$id;
$rel = array();
$pdo=new PDO("mysql:host=localhost;dbname=openjcu","root","12345");
$pdo->query('set names utf8');
try {
    $result = $pdo->query("select count(userName) from user where userName='$name' && pwd='$pwd' ");
//$result2->setFetchMode(PDO::FETCH_OBJ);
    $result->setFetchMode(0);
    $jg = $result->fetch();
    $count = $jg[0][0];//表中记录的条数  strlen($count)
    if ($count == 1) {
        $rt = 1;
        $result=$pdo->query("select * from user where userName='$name' && pwd='$pwd' ");
        $result->setFetchMode(PDO::FETCH_OBJ);
//$result->setFetchMode(0);
        $i=0;
        while ($jg = $result->fetch()) {
            $rel[$i] = $jg;
            $i++;
        }     //表中记录的条数

        $id=$rel[0]->userId;
        //echo '验证用户正确';
    } else {
        $rt = 0;
        //echo '无此用户';
    }
} catch (PDOException $e){
    $rt=0;
}

/*
 * 插入数据
 */

if($rt==0){
    //代表用户名重复
    echo '用户信息错误';
} else if($rt==1) {

    if(isset($_GET['themePics']) || isset($_POST['themePics'])) {
        try {
            if(isset($_GET['themePics']))  $themePics=$_GET['themePics']; else $themePics=$_POST['themePics'];
            // 设置 PDO 错误模式，用于抛出异常
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $insertCmd = "insert into primetheme(title,content,userId,category,themePics) value('$title','$content','$id','$category','$themePics')";
            // $insertCmd = "INSERT INTO user (name, pwd) VALUES ('$name' , '$pwd')";
            // 使用 exec() ，没有结果返回
            $pdo->exec($insertCmd);

            $result = $pdo->query("select themeId from primetheme ORDER by time DESC limit 1");
            //$result2->setFetchMode(PDO::FETCH_OBJ);
            $result->setFetchMode(0);
            $jg = $result->fetch();
            $themeId = $jg[0];//表中记录的条数  strlen($count)

            echo "新记录插入成功,$themeId";
        } catch (PDOException $e) {
            /**
             * 插入数据异常
             */
            echo $insertCmd . "<br>" . $e->getMessage();
        }
    }else{
        try {
            // 设置 PDO 错误模式，用于抛出异常
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $insertCmd = "insert into primetheme(title,content,userID,category) value('$title','$content','$id','$category')";
            // $insertCmd = "INSERT INTO user (name, pwd) VALUES ('$name' , '$pwd')";
            // 使用 exec() ，没有结果返回
            $pdo->exec($insertCmd);

            $result = $pdo->query("select themeId from primetheme ORDER by time DESC limit 1");
            //$result2->setFetchMode(PDO::FETCH_OBJ);
            $result->setFetchMode(0);
            $jg = $result->fetch();
            $themeId = $jg[0];//表中记录的条数  strlen($count)

            echo "新记录插入成功,$themeId";
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