<?php

/**
 * Created by PhpStorm.
 * User: 晞余
 * Date: 2016/12/4
 * Time: 21:09
 */
class Aphp
{
    function connect($table,$name,$number,$class){
        $pdo=new PDO("mysql:host=localhost;dbname=jcjw","root","12345");
        $pdo->query('set names utf8');
        $result=$pdo->query("insert into $table(name,number,classNumber) VALUES ('$name','$number','$class')");
        return $result;
    }
}

?>