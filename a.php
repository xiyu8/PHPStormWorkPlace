<!doctype html>
<?php

if (!session_id()) session_start();
//session_start();
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
	
	text-align:left;
	color:#fff;
	background-color:#7b1000;
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
	background-color:#FFFFFF;
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



<script language="javascript">

	function d4Submit()
			{
				var temp=true;
				var a = document.getElementById("user").value;
				var c = document.getElementById("pwd").value;
				var b= document.getElementById("msg");
				//b.innerHTML=a.length;
				//document.myform.age
				//if(parseInt(a)<0 || parseInt(a)>100)  //parse 将字符串解析为整数
				
				if((a.length<1) || (a.length>18))
				 {
					if(a.length<1)
				  		b.innerHTML="请输入用户名" ;
					 else
						b.innerHTML="用户名要在6个字符以内" ;
					return false;
				  	temp=false;
				}
				if(c.length<6)
				  {
					b.innerHTML="密码要在6个字符以上" ;
				  temp=false;
				}
					return temp;
				}

</script>



<!--	访问者计数器类-->
<?php
 class Count
 {	
 	 var $countfile;  //成员变量一定申明权限
	 var	$fp; 
	 var	$Visitors;
     function __construct(){
    }
    function __destruct(){
    }	
    public function add(){    //返回值不用
    $countfl=fopen("count.txt","r+");
    //$s1=fread($countfl,filesize("count.txt"));
    //$cc=(int)$s1;
    //$cc++;
   // $s1=(string)$cc;
    //fwrite("count.txt",$s1);
   // fclose($count);
   //return $s1
   $fp=fopen("count.txt","r+");
   $v1=intval(fgets($fp));
   $v1++;
   $this->Visitors=$v1;
   rewind($fp);
   fwrite($fp,$v1);
  // fcolse($fp);
   }
 }

 //数据库连接访问,随机显示，qchu()返回couse表结果集
 class Connect_sql{
     public $sj;
	public function qchu(){
		$results=array();
        $i=0;
        $resulto=array();  //存数据库结果返回值：对象数组

        $pdo2=new PDO("mysql:host=localhost;dbname=jcjw","root","12345");
        $pdo2->query('set names utf8');
        $result2=$pdo2->query('select * from couse');
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

<!-- 登陆 -->
<?php
class Login{
	public  $username;
	public $pwd;
	public function getlogin(){


	if(isset($_POST["login"])){

		$results=array();
		$i=0;
		$flag=false;   //标志：在检查完数据库有对应的用户后，变为true

		$this->username=$_POST["user"];   //获 取登录名密码,存到类的成员变量中
		$this->pwd=$_POST["pwd" ];

		//获得student表,并检查有无相应的用户
		$pdo2=new PDO("mysql:host=localhost;dbname=jcjw","root","12345");
		$pdo2->query('set names utf8');
		$result2=$pdo2->query('select * from student');
		$result2->setFetchMode(PDO::FETCH_OBJ);
		while ($jg= $result2->fetch())
		{
			if($jg->number==$this->username && $jg->password==$this->pwd){
				$flag=true;
			}
		}


		if ($flag==true){
			setcookie('username',$this->username);
			setcookie('pwd',$this->pwd);
            $_SESSION["number"]=$this->username;
            $_SESSION["password"]=$this->pwd;
			$n=$this->username;
			echo "<script language=\"javascript\">
					function check(){
					document.getElementById(\"d4\").innerHTML=\"welcome!$n <br><br><br><br><br><br><a href='b_v0.00.php'> · 所有课程</a>\";
					}
				  </script>";
        }
        else{
			echo "<script language=\"javascript\">
					function check(){
					document.getElementById(\"msg\").innerHTML=\"用户名或密码错误!\";
					}
				  </script>";
		}
    }
    else{
		if(isset($_SESSION["number"])){
			$pdo2=new PDO("mysql:host=localhost;dbname=jcjw","root","12345");
			$pdo2->query('set names utf8');
			$result2=$pdo2->query('select * from student');
			$result2->setFetchMode(PDO::FETCH_OBJ);
			$flag=true;
			while ($jg= $result2->fetch())
			{
				if($jg->number==$this->username && $jg->password==$this->pwd){
					$flag=true;
			}
			}


			if ($flag==true){
				$_SESSION["number"]=$_COOKIE['username'];
				$_SESSION["password"]=$_COOKIE['pwd'];
				$n=$_COOKIE['username'];
				echo "<script language=\"javascript\">
					function check(){
					document.getElementById(\"d4\").innerHTML=\"welcome!$n <br><br><br><br><br><br><a href='b_v0.00.php'> · 所有课程</a>\";
					}
				  </script>";
			}
			else {
				echo "<script language=\"javascript\">
					function check(){
					document.getElementById(\"msg\").innerHTML=\"异常：是否在其它地方登陆和修改了密码？请重新登陆\";
					}
				  </script>";
			}
		}

	}
	}
//	public function conSql(){
//		$pdo2=new PDO("mysql:host=localhost;dbname=jcjw","root","12345");
//		$pdo2->query('set names utf8');
//		$result2=$pdo2->query('select * from couse');
//		$result2->setFetchMode(PDO::FETCH_OBJ);
//		public $resulto=arry();
//		public $i=0;
//		while ($jg= $result2->fetch())
//		{
//			$resulto[$i]=$jg;
//			$results[$i] =$jg->Name;
//			$i++;
//		}
//	}
}

$lg=new Login();
$lg->getlogin();

//
//if(isset($_POST["login"])){
//	$username=$_POST["user"];
//	$pwd=$_POST["pwd"];
//	echo $username;
//	//echo '123245';
//} //测试获取表单参数
?>

<!-- 连接数据库，并以对象数组的格式返回查询的结果表  <?php
//    $pdo1=new PDO("mysql:host=localhost;dbname=jcjw","root","12345");
//    $pdo1->query('set names utf8');
//    $result=$pdo1->query('select * from couse');
//    $result->setFetchMode(PDO::FETCH_OBJ);
//

//while ($jg= $result->fetch())
//{
//	echo $jg->Name;
//}
//
//    ?>
-->

</head>

<body onload="check()">
<div id="main">
 
	<div id="d1">
		d1文本
		<a href="http://www.baidu.com">学校主页</a>
		<a href="http://www.baidu.com">教务处</a>
		<a href="http://www.baidu.com">学生处</a>
	</div>
	<div id="d2">
		任选课网上选课系统
	</div>
	<div id="d3">
		<ul>
			<li class="li1"><a href="http://www.baidu.com">学校主页</a></li>
			<li class="li1"><a href="http://www.baidu.com">学生处</a></li>
			<li class="li1"><a href="http://www.baidu.com">团委</a></li>
			<li class="li1"><a href="http://www.baidu.com">公共服务</a></li>
			<li class="li2"><a href="http://www.baidu.com">关于本系统</a></li>
		</ul>
	
	</div>

    <div id="d4d5">
	<div id="d4">
    	<span id="d4_sp1">用户登录</span>
        <hr>
    	<form name="lo" id="d4_form" onSubmit="return d4Submit();" method="POST" action="a.php">
        
        用户名<br><input type="text"  id="user" name="user" size="14"><span id="msg"><br></span>
        密码<br><input type="password" id="pwd" name="pwd" size="15"><br>
        您的身份<br>
            <select name="sl1">
            	<option value="student" selected>学生</option>
            	<option value="teacher">教师</option>
            </select><br>
        <input type="reset" value="重置">
        <input type="submit" value="确定" name="login" onclick="check()">
			
		</form>    <br>
        <span id="sp2">您是第
		<?php
			$c1=new Count();
			$c1->add();
		    echo $c1->Visitors;
		?> 
        个访问者</span>


			</span>
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
    <div><span id="sp1">随机课程展示</span>
      <hr>
        <div id="d6_div">课 程 细 节</div><hr>
<!--		创建访问者数据连接对象，并得到数据表中的一条随机的记录-->
        <?php
        $conect1=new Connect_sql();
        $kc=$conect1->qchu();
        ?>

      <table  width="450" height="204" >
    	<tr align="left" class="tr1"><td id="tr1_td1" width="156" rowspan="8"><img src="<?php echo $conect1->sj; ?>.jpg" width="200"></td>
    	<td 		width="99">编号</td><td width="173"><?php echo $kc->CouseNum; ?></td></tr>
    	<tr class="tr2"><td width="99">名称</td><td width="173"><?php echo $kc->Name; ?></td></tr>
    	<tr class="tr1"><td>类型</td><td><?php echo $kc->kind; ?></td></tr>
    	<tr class="tr2"><td></td><td>3567</td></tr>
    	<tr class="tr1"><td>1344</td><td>3567</td></tr>
    	<tr class="tr2"><td>1344</td><td>3567</td></tr>
    	<tr class="tr1"><td>1344</td><td>3567</td></tr>
    	<tr class="tr2"><td>1344</td><td>3567</td></tr>
</table>
			d6
    </div>
    </div>

</div>

<br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br>



</div>
</body>
</html>
