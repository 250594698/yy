<?php
	$host = "localhost:3306";
	$username = "root";
	$password = 'hell0w0rld';
	$dbname ="yy";//pcms";
	$link = mysql_connect($host,$username,$password) or die("用户名或密码错误");
    $db = mysql_select_db($dbname) or die("数据库连接失败");
	$sql="select * from yy_news limit 1,10";
    $result =	mysql_query($sql);
    var_dump($result);
	
?>
