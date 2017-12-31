<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <script language="JavaScript">

        function inhtml() {   //onClick事件触发JavaScript方法
            var sp1=document.getElementById("sp1");
            var sp2=document.getElementById("sp2");  //找到HTML中的View
            var in1=document.getElementById("in1");
            sp2.innerHTML=in1.value;
            if(sp2.value=="444"){
            sp2.innerHTML="wwww";   //改变View中显示的内容
            a=1;}
            else{
                sp2.innerHTML="444";
                a=0;}
        }
    </script>
    <script src="js1.js"></script>   <!-- 外联js -->
    <style type="text/css">
        body{
            text-align: center;
            background-color: #eeeeee;

        }
        #main{
            margin: auto;
            width: 1000px;
        }

        #d1{
            background-color:#cccccc;
            float: left;
            width: 30%;
        }
        .sb{
            background-color: #3d8bff;
            border: none;
            padding: 8px;
            padding-left: 15px;
            padding-right: 15px;
            margin-left: 0px;
        }
        #in1{
            margin-right: 0px;
            border: none;
            padding: 8px;

        }
        #d2{
            background-color: #ddcc99;
            width: 60%;
            float: left;
            margin-left: 20px;

        }
        #d2 p{
            font-size: 15pt;
        }
        #d1 #sp1{
            font-size: large;
        }
        #d2 #sp2{
            font-size: small;
        }
    </style>
    <link rel="stylesheet" href="c1.css" type="text/css">   <!-- 外联css -->
</head>
<body>
<div id="main">


<div id="d1">
    <span id="sp1" onclick="inhtml()">b1</span><br>
    <form method="get" action="https://www.baidu.com/s">
        <input id="in1" type="text" name="wd">
        <input class="sb" type="submit" id="fr1" value="百度一下">
    </form>
</div>


<div id="d2">
    <span id="sp2" onclick="outofhtml()">b2</span><br>
    <p>插入学生数据</p>
    <form action="../exam/insert.php" method="post">
        <span>名字</span><input type="text" name="name" >
        <span>学号</span><input type="text" name="number">
        <span>班级号</span><select name="class">    <!-- select键值对 class=3 （name=option）-->
            <option>1</option><option>2</option><option>3</option><option>4</option>
        </select>
        <input type="submit" value="提交">
    </form>
</div>


</div>
</body>
</html>





























