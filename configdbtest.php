<?php
	$host = "localhost:3306";
	$username = "root";
	$password = 'hell0w0rld';
	$dbname ="yy";//pcms";
	$link = mysql_connect($host,$username,$password) or die("�û������������");
    $db = mysql_select_db($dbname) or die("���ݿ�����ʧ��");
	$sql="select * from yy_news limit 1,10";
    $result =	mysql_query($sql);
    var_dump($result);
	
?>
