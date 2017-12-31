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
            text-align:center;
        }
        #d1{
            text-align:center;
            margin:auto;
            width: 900px;
            margin:auto;
        }
        #d2{

            text-align:center;
            width: 900px;
            margin:auto;
        }
        tr{
            margin:auto;
        }
        #t1{background-color: #FFFFFF;}
        tr td{
            padding:5px;
            width: 100px;
        }

    </style>

    <?php


    class Search{
        var $rel=array();               //返回的每页数据
        var $page;
        var $rows=3;                    //每页记录条数
        var $count;
        var $keyword;
        var $pagec;
        public function searchCouse(){
            $this->keyword=$_GET['keyword'];
            $k=$this->keyword;
            $pdo2=new PDO("mysql:host=localhost;dbname=jcjw","root","12345");
            $pdo2->query('set names utf8');
            $result2=$pdo2->query("SELECT count(Name) from couse WHERE Name LIKE '%$k%'");
            //$result2->setFetchMode(PDO::FETCH_OBJ);
            $result2->setFetchMode(0);
            $i=0;
            $jg= $result2->fetch();
            $this->count=$jg[0][0];     //符合查询条件的记录的条数
            return $pdo2;
        }
        public function toSearch()
        {
            if (isset($_GET['keyword'])) {
                $this->keyword=$_GET['keyword'];
            if (isset($_GET['page'])) {

                $pdo2 = self::searchCouse();   //得到数据库的操作句柄
                $this->page = $_GET['page'];       //当前页码
                $this->pagec=$this->count / $this->rows;
                if($this->count % $this->rows != 0)
                    $this->pagec++;
                $this->pagec=floor($this->pagec);
                if ($_GET['mode'] == 1)
                    $this->page++;
                if ($_GET['mode'] == 2)
                    $this->page--;
                if ($this->page < 1)
                    $this->page++;
                if ($this->page > $this->pagec)
                    $this->page--;
                $f2 = ($this->page - 1) * $this->rows;   //已知页码和每页条数；显示从f2条开始，显示rows条
                $n = $this->rows;
                $k = $this->keyword;
                $result2 = $pdo2->query("select * from couse WHERE Name LIKE '%$k%' limit $f2,$n");
                //  $result2 = $pdo2->query("select * from couse WHERE Name LIKE '%$k%'");
                $result2->setFetchMode(PDO::FETCH_OBJ);
                $i = 0;
                while ($jg = $result2->fetch()) {
                    $this->rel[$i] = $jg;
                    $i++;
                }

                $i = 0;
                while ($i < $this->rows) {     //按要求打印一定数量的表格行数
                    if(($this->page==($this->pagec))&&(($this->count % $this->rows) <> 0)){
                        while ($i < ($this->count % $this->rows)) {
                            $bb1 = $this->rel[$i]->CouseNum;
                            $bb2 = $this->rel[$i]->Name;
                            $bb3 = $this->rel[$i]->Teacher;
                            echo "<tr bgcolor=\"#eeeeee\"> <td>$bb1 </td> <td>$bb2 </td> <td>$bb3 </td> <td></td> <td></td> </tr>";
                            $i++;
                        }
                        break;
                    }
                    $bb1 = $this->rel[$i]->CouseNum;
                    $bb2 = $this->rel[$i]->Name;
                    $bb3 = $this->rel[$i]->Teacher;
                    echo "<tr bgcolor=\"#eeeeee\"> <td>$bb1 </td> <td>$bb2 </td> <td>$bb3 </td> <td></td> <td></td> </tr>";
                    $i++;

                }
                $p1 = $this->page;
                echo "<tr><td colspan='5'><a href=\"?page=$p1&mode=1&keyword=$k\">下一页</a> <a href=\"?page=$p1&mode=2&keyword=$k\">上一页</a></td></tr>"; //双引号里面的变量不能留空格

                return $this->rel;
            } else {
                $this->page = 1;
                $k = $this->keyword;
                $pdo2 = self::searchCouse();   //得到数据库的操作句柄
                $result2 = $pdo2->query("select * from couse WHERE Name LIKE '%$k%'");
                //$result2=$pdo2->query('select * from couse limit 0,'.$this->rows);
                $result2->setFetchMode(PDO::FETCH_OBJ);
                $i = 0;
                while ($jg = $result2->fetch()) {
                    $this->rel[$i] = $jg;
                    $i++;
                }

                $i = 0;
                while ($i < $this->rows) {     //按要求打印一定数量的表格行数
                    $bb1 = $this->rel[$i]->CouseNum;
                    $bb2 = $this->rel[$i]->Name;
                    $bb3 = $this->rel[$i]->Teacher;
                    echo "<tr bgcolor=\"#eeeeee\"> <td>$bb1 </td> <td>$bb2 </td> <td>$bb3 </td> <td></td> <td></td> </tr>";
                    $i++;
                }
                $p1 = $this->page;
                echo "<tr><td colspan='5'><a href=\"?page=$p1&mode=1&keyword=$k\">下一页</a> <a href=\"?page=$p1&mode=2&keyword=$k\">上一页</a></td></tr>";

                return $this->rel;
            }
        }
        }
    }


    $sch=new Search();





    //
    //if(isset($_POST["login"])){
    //	$username=$_POST["user"];
    //	$pwd=$_POST["pwd"];
    //	echo $username;
    //	//echo '123245';
    //} //测试获取表单参数



    ?>

</head>




<body>
<div id="main">



<div id="d1">
    <form name="lo" id="d1_form" method="GET" action="c.php">
        <span>请输入课程关键字</span><input type="text"  id="keyword" name="keyword" size="14"><input type="submit" value="搜索">
    </form>
</div>

<div id="d2">
    <table id="t1" >
        <tr >  <td>课程代号</td> <td>课程名称</td> <td>老师</td> <td>时间</td>  <td>说明</td> </tr>
        <?php $sch->toSearch();
        ?>
    </table>
</div>





</div>
</body>
</html>