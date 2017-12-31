<?php




$groupName=$_GET['groupName'];

$cmd="delete from MyGroup WHERE groupId='$groupName'";

$pdo=new PDO("mysql:host=localhost;dbname=openjcu","root","12345");
$pdo->query('set names utf8');

$result=$pdo->exec($cmd);

echo "OK".$result;

?>