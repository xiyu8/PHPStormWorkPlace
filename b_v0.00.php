<!DOCTYPE html>
<!-- 此函数显示数据库中的couse表的信息，table中的行全部echo得到 -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style type="text/css">

        body{background-color:rgba(224,224,224,0.5); text-align:center;}
        #main{
            background-color: #fff;
            width: 900px;
            margin:auto;
            margin-top: 0px;
            text-align:center;
        }
        table{

            margin:auto;
        }

        #t1{background-color: #FFFFFF;}
        tr td{
            padding:5px;
            width: 100px;
        }

    </style>

    <?php
    class Detail{
        var $rel=array();               //返回的每页数据
        var $page;
        var $rows=2;                    //每页记录条数
        var $count;
        public function searchCouse(){
            $pdo2=new PDO("mysql:host=localhost;dbname=jcjw","root","12345");
            $pdo2->query('set names utf8');
            $result2=$pdo2->query('SELECT count(Name) from couse');
            //$result2->setFetchMode(PDO::FETCH_OBJ);
            $result2->setFetchMode(0);
            $i=0;
            $jg= $result2->fetch();
            $this->count=$jg[0][0];     //表中记录的条数
            return $pdo2;
        }
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

                $pdo2=self::searchCouse();   //得到数据库的操作句柄
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

                $i=0;
                while ($i<$this->rows){     //按要求打印一定数量的表格行数
                    $bb1=$this->rel[$i]->CouseNum;
                    $bb2=$this->rel[$i]->Name;
                    $bb3=$this->rel[$i]->Teacher;
                    echo "<tr bgcolor=\"#eeeeee\"> <td>$bb1 </td> <td>$bb2 </td> <td>$bb3 </td> <td></td> <td></td> </tr>";
                    $i++;}
                $p1=$this->page;
                echo "<tr><td colspan='5'><a href=\"?page=$p1&mode=1\">下一页</a> <a href=\"?page=$p1&mode=2\">上一页</a></td></tr>"; //双引号里面的变量不能留空格

                return $this->rel;
            }
            else {
                $this->page=1;
                $pdo2=self::searchCouse();   //得到数据库的操作句柄
                $result2=$pdo2->query('select * from couse limit 0,'.$this->rows);
                $result2->setFetchMode(PDO::FETCH_OBJ);
                $i=0;
                while ($jg= $result2->fetch())
                {
                    $this->rel[$i]=$jg;
                    $i++;
                }

                $i=0;
                while ($i<$this->rows){     //按要求打印一定数量的表格行数
                    $bb1=$this->rel[$i]->CouseNum;
                    $bb2=$this->rel[$i]->Name;
                    $bb3=$this->rel[$i]->Teacher;
                echo "<tr bgcolor=\"#eeeeee\"> <td>$bb1 </td> <td>$bb2 </td> <td>$bb3 </td> <td></td> <td></td> </tr>";
                $i++;}   $p1=$this->page;
                echo "<tr><td colspan='5'><a href=\"?page=$p1&mode=1\">下一页</a> <a href=\"?page=$p1&mode=2\">上一页</a></td></tr>";

                return $this->rel;
            }
        }
    }


    $d1=new Detail();
    ?>

</head>




<body>
<div id="main">

    <table id="t1" >
        <tr >  <td>课程代号</td> <td>课程名称</td> <td>老师</td> <td>时间</td>  <td>说明</td> </tr>
        <?php $ds=$d1->gainCouse();
        ?>
    </table>






</div>
</body>
</html>