<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <?php
    ?>
</head>
<body>
<div>
    <?php
    foreach ($_REQUEST as $key=>$value){  //遍历上传的所有参数的键值对(索引数组)(cookie post get)
        echo "$key :$value <br>";
    }

    if(isset($_REQUEST)) {
        $feedback = $_REQUEST["feedback"];
        $pdo = new PDO("mysql:host=localhost;dbname=jincheng", "root", "12345");
        $pdo->query('set names utf8');
        $result=$pdo->query('SELECT count(*) from FeedBack');
        $jg= $result->fetch();
        $jp1=$jg[0][0];  $jp1++;

        $result=$pdo->query("insert into FeedBack(id,info) VALUES ('$jp1','$feedback')");
        if($result){
            echo "succese";
        }
        else
            echo "fail";
    }
    ?>
</div>


</body>
</html>