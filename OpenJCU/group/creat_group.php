<?php
/**
 * Created by PhpStorm.
 * User: 晞余
 * Date: 2017/4/15
 * Time: 15:31
 */
$ower=$_GET['IMME'];
$position=$_GET['ownerPosition'];


$pdo=new PDO("mysql:host=localhost;dbname=openjcu","root","12345");
$pdo->query('set names utf8');



$authnum;
function dd()
{
    srand((double)microtime() * 1000000);//create a random number feed.
    $ychar = "0,1,2,3,4,5,6,7,8,9,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z";
    $list = explode(",", $ychar);
    $authnum = "";
    for ($i = 0; $i < 6; $i++) {
        $randnum = rand(0, 35); // 10+26;
        $authnum = $list[$randnum] . $authnum;
    }
    return $authnum;
}
$authnum=dd();

$precmd="select * from MyGgroup where groupId=$authnum";

$cc=1;
for(;$cc==0;){
    $authnum=dd();
    $result=$pdo->query($precmd);
    $result->setFetchMode(PDO::FETCH_OBJ);
    $cc=$result->rowCount();
}


$cmd1="insert into MyGroup(groupId,ownerId) value('$authnum','$ower')";
$cmd2="insert into member(memberId,groupId,memberPosition) value('$ower','$authnum','$position')";

$result=$pdo->exec($cmd1);
$result=$pdo->exec($cmd2);

if($result!=1){
    echo "出错";
}else
    echo $authnum;




?>