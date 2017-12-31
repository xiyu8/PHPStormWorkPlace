<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style type="text/css">

        body{background-color:rgba(224,224,224,0.5); text-align:center;}
        #main{
            background-color: #fff;
            width: 600px;
            margin:auto;
        }

        #t1{background-color: #FFFFFF;}
        tr td{
            padding:5px;
        }

    </style>

    <?php
    class Detail{
        var $rel=array();               //返回的每页数据
        var $page;
        var $rows=2;                    //每页记录条数


        var $count;
        public function gainCouse(){

//                $pdo2=new PDO("mysql:host=localhost;dbname=jcjw","root","12345");
//                $pdo2->query('set names utf8');
//                $result2=$pdo2->query('select * from couse');
//                $result2->setFetchMode(PDO::FETCH_OBJ);
//                $i=0;
//                while ($jg= $result2->fetch())
//                {
//                    $this->rel[$i]=$jg;
//                    $i++;
//                }
            //   return $this->rel;


            if(isset($_GET['page'])){

                $pdo2=new PDO("mysql:host=localhost;dbname=jcjw","root","12345");
                $pdo2->query('set names utf8');
                $result2=$pdo2->query('SELECT count(Name) from couse');
                //$result2->setFetchMode(PDO::FETCH_OBJ);
                $result2->setFetchMode(0);
                $i=0;
                $jg= $result2->fetch();
                $this->count=$jg[0][0];     //表中记录的条数
                $this->rows=2;                    //每页记录条数
                $this ->page=$_GET['page'];       //当前页码
                if($_GET['mode']==1)
                    $this->page++;
                if($_GET['mode']==2)
                    $this->page--;

                if($this->page<1)
                    $this->page++;
                if($this->page>($this->count/$this->rows))
                    $this->page--;
                $result2=$pdo2->query('select * from couse limit '.($this ->page-1)*$this->rows.','.$this->rows);
                $result2->setFetchMode(PDO::FETCH_OBJ);
                $i=0;
                while ($jg= $result2->fetch())
                {
                    $this->rel[$i]=$jg;
                    $i++;
                }
                return $this->rel;
            }
            else {
                $this->page=1;
                $pdo2 = new PDO("mysql:host=localhost;dbname=jcjw", "root", "12345");
                $pdo2->query('set names utf8');
                $result2=$pdo2->query('select * from couse limit 0,'.$this->rows);
                $result2->setFetchMode(PDO::FETCH_OBJ);
                $i=0;
                while ($jg= $result2->fetch())
                {
                    $this->rel[$i]=$jg;
                    $i++;
                }
                return $this->rel;
            }
        }
    }


    $d1=new Detail();
    $ds=$d1->gainCouse();
    ?>

</head>




<body>
<div id="main">

    <table id="t1" >
        <tr >  <td>课程代号</td> <td>课程名称</td> <td>老师</td> <td>时间</td>  <td>说明</td> </tr>
        <tr bgcolor="#eeeeee"> <td><?php echo $ds[0]->CouseNum; ?></td> <td><?php echo $ds[0]->Name; ?></td> <td><?php echo $ds[0]->Teacher; ?></td> <td></td> <td></td> </tr>
        <tr> <td><?php echo $ds[1]->CouseNum; ?></td> <td><?php echo $ds[1]->Name; ?></td> <td><?php echo $ds[1]->Teacher; ?></td> <td></td> <td></td> </tr>
    </table>

    <a href="?page=<?php echo $d1->page; ?>&mode=1">下一页</a> <a href="?page=<?php echo $d1->page; ?>&mode=2">上一页</a>


    <?php
    $pdo2=new PDO("mysql:host=localhost;dbname=jcjw","root","12345");
    $pdo2->query('set names utf8');
    $result2=$pdo2->query('SELECT count(Name) from couse');
    //$result2=$pdo2->query('select * from couse');
    //$result2->setFetchMode(PDO::FETCH_OBJ);
    $result2->setFetchMode(0);
    $i=0;
    $jg= $result2->fetch();

    //echo $jg->count(Name);
    echo $jg[0][0];

    ?>

</div>
</body>
</html>