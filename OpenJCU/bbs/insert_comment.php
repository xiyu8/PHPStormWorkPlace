<?php
/*
 * 参数：$_GET['username']、$_GET['pwd']、$_GET['supusername']、$_GET['content']、$_GET['themeid']  $_GET["commentPics"]
 * 返回值：新记录插入成功
 */

$servername = "localhost";
$dbname = "openjcu";
$username = "root";
$password = "12345";
/**
 * 验证用户信息
 *
 */
$name=$_GET['username'];
$pwd=$_GET['pwd'];
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


//////////////////////////////////////
$supusername=$_GET['supusername'];
$supuserid;
$result=$pdo->query("select * from user where userName='$supusername' ");
$result->setFetchMode(PDO::FETCH_OBJ);
//$result->setFetchMode(0);
$i=0;
while ($jg = $result->fetch()) {
    $rel[$i] = $jg;
    $i++;
}     //表中记录的条数

$supuserid=$rel[0]->userId;



/*
 * 插入数据
 */
$content=$_GET['content'];
$themeid=$_GET['themeid'];

if($rt==0){
    //代表用户名重复
    echo '用户信息错误';
} else if($rt==1) {



    if(isset($_GET["commentPics"])){
        $commentPics=$_GET["commentPics"];
        try {
            // 设置 PDO 错误模式，用于抛出异常
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $insertCmd = "insert into comment(commentContent,themeId,userId,commentPics) value('$content','$themeid','$id','$commentPics')";
            $pdo->exec($insertCmd);


            $result = $pdo->query("select commentId from comment ORDER by commentTime DESC limit 1");
            //$result2->setFetchMode(PDO::FETCH_OBJ);
            $result->setFetchMode(0);
            $jg = $result->fetch();
            $commentId = $jg[0];//表中记录的条数  strlen($count)
            echo "新记录插入成功,".$commentId;
        } catch(PDOException $e) {//插入数据异常
            echo $insertCmd . "<br>" . $e->getMessage();
        }
    }else{
        try {
        // 设置 PDO 错误模式，用于抛出异常
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $insertCmd = "insert into comment(commentContent,themeId,userId) value('$content','$themeid','$id')";
            $pdo->exec($insertCmd);


            $result = $pdo->query("select commentId from comment ORDER by commentTime DESC limit 1");
            $result->setFetchMode(0);
            $jg = $result->fetch();
            $commentId = $jg[0];//表中记录的条数  strlen($count)
            echo "新记录插入成功,".$commentId;
        } catch(PDOException $e) {//插入数据异常
            echo $insertCmd . "<br>" . $e->getMessage();
        }
    }








}
$pdo = null;

?>