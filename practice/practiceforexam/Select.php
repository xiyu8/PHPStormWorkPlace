<?php

/**
 * Created by PhpStorm.
 * User: 晞余
 * Date: 2016/12/4
 * Time: 21:29
 */
class Select
{
    var $rels=array();
    function toSelect(){
        $pdo = new PDO("mysql:host=localhost;dbname=jcjw", "root", "12345");
        $pdo->query('set namrs utf8');
        $result=$pdo->query("");
        $result->setFetchMode(PDO::FETCH_OBJ);

        $arr=array(); $i=0;
        while ($jp=$result->fetch()){
            $arr[$i]=$jp;
        }

        return $arr;
    }
    function toInsert($name,$number,$class){
        $pdo = new PDO("mysql:host=localhost;dbname=jcjw", "root", "12345");
        $pdo->query('set names utf8');
        $result=$pdo->query("insert into student(name,number,classNumber) VALUES ('$name','$number','$class')");

        return $result;
    }
    function toUpdate(){
        $pdo = new PDO("mysql:host=localhost;dbname=jcjw", "root", "12345");
        $pdo->query('set namrs utf8');
        $result=$pdo->query("update student classNumber='1' where number='140810111'");
        $result->setFetchMode(PDO::FETCH_OBJ);

        return $result;
    }
    function toDelete(){
        $pdo = new PDO("mysql:host=localhost;dbname=jcjw", "root", "12345");
        $pdo->query('set namrs utf8');
        $result=$pdo->query("delete from student where name='222'");

        return $result;
    }
    function toCount(){
        $pdo=new PDO("mysql:host=localhost;dbname=jcjw","root","12345");
        $pdo->query('set names utf8');
        $result=$pdo->query('SELECT count(Name) from couse');
        $result->setFetchMode(0);

        $jg= $result->fetch();
        return $jg[0][0];
    }
}