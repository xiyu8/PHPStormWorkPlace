<?php
/**
 * Created by PhpStorm.
 * User: 晞余
 * Date: 2017/4/13
 * Time: 17:59
 */

$time;
if(isset($_GET['time'])) {
    $time = $_GET['time'];
}else{
    $time='20'.date('y-m-d h:i:s',time()+24*3600);
}
//echo $time;
$rps;  //返回值

$rel = array();
$pdo=new PDO("mysql:host=localhost;dbname=openjcu","root","12345");
$pdo->query('set names utf8');
//select * from primetheme join user on primetheme.userId=user.id;
$result=$pdo->query("select * from lostandfound WHERE l_f_time<'$time' ORDER by l_f_time DESC limit 10");
//$result->setFetchMode(PDO::FETCH_OBJ);
$result->setFetchMode(5);
//echo $result->rowCount();  记录条数
//$result->setFetchMode(0);
$i=0;

if($result->rowCount()==0){     //判断查询结果 记录的条数
    echo "无记录";
}else {
    while ($jg = $result->fetch()) {
        $rel[$i] = $jg;
        $i++;
    }

//echo  $rel[0]->id;
    echo json_encode($rel);
//json_decode
}


?>