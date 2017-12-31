<?php
/**
 * Created by PhpStorm.
 * User: 晞余
 * Date: 2017/4/23
 * Time: 11:28
 */


$time;
if(isset($_GET['time'])) {
    $time = $_GET['time'];

}else{
    $time='20'.date('y-m-d h:i:s',time()+24*3600);
}
$jobFlag;
if(isset($_GET['jobFlag'])) {
    $jobFlag = $_GET['jobFlag'];
}else{
    $jobFlag='0';
}
//echo $time;
$rps;  //返回值

$rel = array();
$pdo=new PDO("mysql:host=localhost;dbname=openjcu","root","12345");
$pdo->query('set names utf8');
//select * from primetheme join user on primetheme.userId=user.id;
$result=$pdo->query("select * from colorfulwall where memoCreatTime<'$time' ORDER by memoCreatTime DESC limit 10");
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