<?php


//$rel = array();
//$pdo=new PDO("mysql:host=localhost;dbname=openjcu","root","12345");
//$pdo->query('set names utf8');
//$result=$pdo->query('select * from user where name=\'xiyu\' && pwd=\'12345\'');
//$result->setFetchMode(PDO::FETCH_OBJ);
////$result->setFetchMode(0);
//$i=0;
//while ($jg = $result->fetch()) {
//    $rel[$i] = $jg;
//    $i++;
//}     //表中记录的条数
//
//if("2017-03-19 14:06:31">($rel[0]->CreateTime)){
//
//    echo  "000000000000";
//}else
//    echo "1111111111111111";
//
//echo  $rel[0]->CreateTime;

/*
 *获取themeList
 * 参数：$_GET['time']
 * 返回值：包含10个对象的  Json对象数组
 *          2、无记录
 *
 */
$time;
if(isset($_GET['time'])) {
    $time = $_GET['time'];
}else{
    $time='20'.date('y-m-d h:i:s',time()+24*3600);
}
$category;
if(isset($_GET['category'])) {
    $category = $_GET['category'];
}else{
    $category='1';
}
//echo $time;
$rps;  //返回值

$rel = array();
$pdo=new PDO("mysql:host=localhost;dbname=openjcu","root","12345");
$pdo->query('set names utf8');
//select * from primetheme join user on primetheme.userId=user.id;
$result=$pdo->query("select * from primetheme join user on primetheme.userId=user.userId where time<'$time' && category='$category' ORDER by time DESC limit 10");
$result->setFetchMode(PDO::FETCH_OBJ);
//echo $result->rowCount();  记录条数
//$result->setFetchMode(0);
$i=0;

if($result->rowCount()==0){     //判断查询结果 记录的条数
    echo "无记录";
}else {
    while ($jg = $result->fetch()) {
            $rel[$i] = $jg;
            $i++;
    }

//echo  $rel[0]->id;
        echo json_encode($rel);
//json_decode
}


















//我用php函数echo date("Y-m-d H:i:s",1383346800);  运行结果是：2013-11-01 23:00:00
//而用mysql函数select from_unixtime(1383346800);   运行结果是：2013-11-02 07:00:00

//SELECT UNIX_TIMESTAMP(2009-4-5 12:50:58)  RROM DUAL;
//-- 结果为:
//1238907058
//
//SELECT FROM_UNIXTIME(1238907058) FROM DUAL;
//-- 结果为:
//'2009-4-5 12:50:58'
//
//echo date("Y-m-d H:i:s",1383346800);
//echo time();//date('y-m-d h:i:s',time());


?>