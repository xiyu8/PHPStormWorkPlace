<?php
/**
 * Created by PhpStorm.
 * User: 晞余
 * Date: 2017/4/5
 * Time: 20:13
 */
/*
 * 参数： $_POST['themeId']; $_FILE['themePic1'][''] 、$_FILE['themePic2']['']...
 */

$themeId = $_POST['themeId'];

$upload_dir=getcwd()."\\..\\themePics\\".$themeId."\\";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir);
}


$i=1;
if(file_exists($_FILES['themePic1']['tmp_name'])) {
    $uploadDirAndFile=$upload_dir.$i.'.jpg';
    move_uploaded_file($_FILES['themePic1']['tmp_name'],$uploadDirAndFile);
    $i+=1;
    if(file_exists($_FILES['themePic2']['tmp_name'])) {
        $uploadDirAndFile=$upload_dir.$i.'.jpg';
        move_uploaded_file($_FILES['themePic2']['tmp_name'],$uploadDirAndFile);
        $i+=1;
    }
    if(file_exists($_FILES['themePic3']['tmp_name'])) {
        $uploadDirAndFile=$upload_dir.$i.'.jpg';
        move_uploaded_file($_FILES['themePic3']['tmp_name'],$uploadDirAndFile);
    }
    echo "{\"erroCode\":\"0\"}";
}else{

    echo "{\"erroCode\":\"1\"}";

    while (!file_exists($_FILES['themePic1']['tmp_name'])){

    }

    move_uploaded_file($_FILES['themePic1']['tmp_name'],$uploadDirAndFile);
    echo "{\"erroCode\":\"0\"}";
}
?>