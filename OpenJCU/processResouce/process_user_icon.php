<?php
/**
 * Created by PhpStorm.
 * User: 晞余
 * Date: 2017/4/4
 * Time: 21:09
 */
/* 处理上传的一个用户头像文件
参数：$_POST['userId']、$_FILES['upload']

返回值：
 *
 */

$picName = $_POST['userId'];

$upload_dir=getcwd()."\\..\\userIcon\\";
//if (!is_dir($upload_dir)) {
//    mkdir($upload_dir);
//}
$uploadDirAndFile=$upload_dir.$picName.'.jpg';
if(file_exists($_FILES['userIcon']['tmp_name'])) {
    move_uploaded_file($_FILES['userIcon']['tmp_name'],$uploadDirAndFile);
    echo "{\"erroCode\":\"0\"}";
}else{

    echo "{\"erroCode\":\"1\"}";

    while (!file_exists($_FILES['userIcon']['tmp_name'])){

    }

    move_uploaded_file($_FILES['userIcon']['tmp_name'],$uploadDirAndFile);
    echo "{\"erroCode\":\"0\"}";
}

?>