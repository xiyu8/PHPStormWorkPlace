<?php
/**
 * Created by PhpStorm.
 * User: 晞余
 * Date: 2017/4/5
 * Time: 20:30
 */


$commentId = $_POST['commentId'];

$upload_dir=getcwd()."\\..\\commentPics\\".$commentId."\\";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir);
}


$i=1;
if(file_exists($_FILES['commentPic']['tmp_name'])) {
    $uploadDirAndFile=$upload_dir.$i.'.jpg';
    move_uploaded_file($_FILES['commentPic']['tmp_name'],$uploadDirAndFile);

    echo "{\"erroCode\":\"0\"}";
}else{

    echo "{\"erroCode\":\"1\"}";

    while (!file_exists($_FILES['commentPic']['tmp_name'])){

    }

    move_uploaded_file($_FILES['commentPic']['tmp_name'],$uploadDirAndFile);
    echo "{\"erroCode\":\"0\"}";
}
?>