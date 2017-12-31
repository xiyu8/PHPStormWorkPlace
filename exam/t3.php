<!doctype html>
<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <title>选课首页</title>
    <!-- erfwe -->
    <style type="text/css">
        body{background-color:rgba(220,225,220,0.5); text-align:center;}
        #main{
            background-color: #fff;
            width: 1000px;
            margin:auto;
        }
        #d1{
            text-align: right;
        //	font-style: 宋体;
            background-color: #313729;
            color: #ffffff;
            padding:5px;

        }
        #d1 a{
            color:#fff;
            text-decoration:none;
            margin-right:8px;
            margin-left:10px;
        }
        #d5 a{
            color:#000;
        }
        #d1 a:visited{
        }
        #d1 a:hover{
        }
        #d2{

            text-align:center;
            color:#000;
            background-color:#60f4f4;
            font-size:36px;
            padding-left:25px;
            padding-top:6px;
            padding-bottom:6px;
        }
        #d3{
            text-align:left;
            background-color:#5a6052;
            color:#fff;
        }
        input{
            margin-top:5px;

            margin-bottom:5px;
        }
        select{
            margin-top:5px;
            margin-bottom:5px;
        }
        ul{
            margin-top:0px;
        }
        ul .li1{
            float:left;
            list-style-type:none;
        }
        ul .li2{
            list-style-type:none;
        }
        ul li{
            padding-top:5px;
            padding-bottom:5px;
            padding-right:25px;

        }
        #d4d5{
            float:left;width:30%;
        }
        #d4{
            text-align:left;
            background-color:#fff;
            padding:5px;
            padding-top:8px;
            margin-right:18px;
        }
        #d4 span{
            font-size:22px;

        }
        #d4 #sp2{
            font-size:15px;
        }
        #d5{
            text-align:left;
            background-color:#FFFFFF;
            margin-right:18px;
            margin-top:15px;
            margin-left:3px;
            padding:5px;
            padding-top:8px;

        }
        #d5 span{
            font-size:20px;

        }
        #d5_ul li{
        }
        #d6{
            text-align:left;
            float:right;
            width:70%;
        }
        #d6 div{
            padding:6px;
            padding-top:8px;
        }
        #d6 .tr1{
            background-color:rgba(224,224,224,1.00);
        }
        #d6 #sp1{
            font-size:22px;
        }
        #d6 #tr1_td1{
            background-color:#fff;
        }

        #d6 #d6_div{
            font-size:22px;
            text-align:center;
            background-color:#FFFFFF;
            padding:0px;
        }

        tr td{
            padding:5px;
        }


        a{
            color:#fff;
            text-decoration:none;
        }
        #d4 a{
            color: blue;
        }
        a:visited{
        }
        a:hover{
        }
        tr td{
        }
    </style>

<?php


class Connect_sql{
     public $sj;
	public function qchu(){
		$results=array();
        $i=0;
        $resulto=array();  //存数据库结果返回值：对象数组

        $pdo2=new PDO("mysql:host=localhost;dbname=jincheng","root","12345");
        $pdo2->query('set names utf8');
    $result2=$pdo2->query('select * from Prodect');
    $result2->setFetchMode(PDO::FETCH_OBJ);
    while ($jg= $result2->fetch())
    {
    $resulto[$i]=$jg;
    $results[$i] =$jg->Name;
    $i++;
    }

    $xs=floor(rand(0,2));//取0到2的随机整数
    $this->sj=$xs;
    return $resulto[$xs];
    }
    }
?>

</head>

<body onload="check()">
<div id="main">


    <div id="d2">
        锦 城 公 司
    </div>
    <div id="d3">
        <ul>
            <li class="li1"><a href="http://www.baidu.com">管理部门</a></li>
            <li class="li1"><a href="http://www.baidu.com">销售</a></li>
            <li class="li1"><a href="http://www.baidu.com">研发</a></li>
            <li class="li1"><a href="http://www.baidu.com">售后</a></li>
            <li class="li2"><a href="http://www.baidu.com">客服</a></li>
        </ul>

    </div>

    <div id="d4d5">
       <div id="d4">
           大事记  <br><br><br><br><br><br><br><br><br><br>
           </div>
        <div id="d5">
            <span>快速链接</span><hr>
            <ul id="d5_ul">
                <li><a href="http://www.baidu.com">使用方法</a></li>
                <li><a href="http://www.baidu.com">常见问题</a></li>
                <li><a href="http://www.baidu.com">联系我们</a></li>

            </ul>
            d5
        </div>
    </div>

    <div id="d6" >
        <div><span id="sp1"></span>
            <hr>
            <div id="d6_div">产 品 展 示</div><hr>
            <table  width="450" height="204" >
                <tr align="left" class="tr1"><td id="tr1_td1" width="156" rowspan="8"><img src="" width="200"></td>
                <tr> <?php $p=new Connect_sql(); $p->qchu(); echo $p  ?></tr>

            </table>
            d6
        </div>

        <div style="margin-top: 12px;background-color: #fff">

           <h3>新 闻</h3>
            </div>
    </div>

</div>





</div>
</body>
</html>
