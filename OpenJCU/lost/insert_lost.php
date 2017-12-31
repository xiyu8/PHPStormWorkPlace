<?php

/*
 * 参数：$_GET['username']、$_GET['pwd']、$_GET['goodName']、$_GET['goodDescription']、$_GET['category']
 * 返回值：新记录插入成功
 */

/**
 * Created by PhpStorm.
 * User: 晞余
 * Date: 2017/3/22
 * Time: 20:04
 */


//////////////////////////////////////Post Get 兼容程序/////////////////////////////////////////////////
//if(isset($_GET['username']))  $name=$_GET['username'];
//if(isset($_GET['pwd']))  $pwd=$_GET['pwd'];
if(isset($_GET['goodName']))  $goodName=$_GET['goodName'];
if(isset($_GET['goodDescription']))  $goodDescription=$_GET['goodDescription'];
if(isset($_GET['l_f_flag']))  $l_f_flag=$_GET['l_f_flag'];
if(isset($_GET['l_f_pics']))  $l_f_pics=$_GET['l_f_pics'];

//if(isset($POST['username']))  $name=$POST['username'];
//if(isset($POST['pwd']))  $pwd=$POST['pwd'];
if(isset($POST['goodName']))  $goodName=$POST['goodName'];
if(isset($POST['goodDescription']))  $goodDescription=$POST['goodDescription'];
if(isset($POST['l_f_flag']))  $l_f_flag=$POST['l_f_flag'];
if(isset($POST['l_f_pics']))  $l_f_pics=$POST['l_f_pics'];
echo "uuuu".$goodName.$goodDescription.$l_f_flag;
///////////////////////////////////////////////////////////////////////////////////////

$servername = "localhost";
$dbname = "openjcu";
$username = "root";
$password = "12345";
/**
 * 验证用户信息
 *
 */
//$rt;
//$id;
//$rel = array();
$pdo=new PDO("mysql:host=localhost;dbname=openjcu","root","12345");
$pdo->query('set names utf8');
//try {
//    $result = $pdo->query("select count(userName) from user where userName='$name' && pwd='$pwd' ");
////$result2->setFetchMode(PDO::FETCH_OBJ);
//    $result->setFetchMode(0);
//    $jg = $result->fetch();
//    $count = $jg[0][0];//表中记录的条数  strlen($count)
//    if ($count == 1) {
//        $rt = 1;
//        $result=$pdo->query("select * from user where userName='$name' && pwd='$pwd' ");
//        $result->setFetchMode(PDO::FETCH_OBJ);
////$result->setFetchMode(0);
//        $i=0;
//        while ($jg = $result->fetch()) {
//            $rel[$i] = $jg;
//            $i++;
//        }     //表中记录的条数
//
//        $id=$rel[0]->userId;
//        //echo '验证用户正确';
//    } else {
//        $rt = 0;
//        //echo '无此用户';
//    }
//} catch (PDOException $e){
//    $rt=0;
//}

/*
 * 插入数据
 */
$rt=1;
if($rt==0){
    //代表用户名重复
    echo '用户信息错误';
} else if($rt==1) {

    if(isset($_GET['l_f_pics']) || isset($_POST['l_f_pics'])) {
        try {
            // 设置 PDO 错误模式，用于抛出异常
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $insertCmd = "insert into lostandfound(l_f_title,l_f_content,l_f_pics,l_f_flag) value('$goodName','$goodDescription','$l_f_pics','$l_f_flag')";
            // $insertCmd = "INSERT INTO user (name, pwd) VALUES ('$name' , '$pwd')";
            // 使用 exec() ，没有结果返回
            $pdo->exec($insertCmd);

            $result = $pdo->query("select l_f_id from lostandfound ORDER by l_f_time DESC limit 1");
            //$result2->setFetchMode(PDO::FETCH_OBJ);
            $result->setFetchMode(0);
            $jg = $result->fetch();
            $l_f_id = $jg[0];//表中记录的条数  strlen($count)

            echo "新记录插入成功,$l_f_id";
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
            $insertCmd = "insert into lostandfound(l_f_title,l_f_content,l_f_flag) value('$goodName','$goodDescription','$l_f_flag')";
            // $insertCmd = "INSERT INTO user (name, pwd) VALUES ('$name' , '$pwd')";
            // 使用 exec() ，没有结果返回
            $pdo->exec($insertCmd);

            $result = $pdo->query("select l_f_id from lostandfound ORDER by l_f_time DESC limit 1");
            //$result2->setFetchMode(PDO::FETCH_OBJ);
            $result->setFetchMode(0);
            $jg = $result->fetch();
            $l_f_id = $jg[0];//表中记录的条数  strlen($count)

            echo "新记录插入成功,$l_f_id";
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