<?php
/**
 * Created by PhpStorm.
 * User: 晞余
 * Date: 2017/4/23
 * Time: 16:09
 */

$memoId = $_POST['memoId'];

$upload_dir=getcwd()."\\..\\playgroundPics\\".$memoId."\\";
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