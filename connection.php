<?php
$hostname="localhost";
$username="root";
$password="";
$dbname="student";
$link = mysql_connect($hostname, $username, $password) or die ("html>script language='JavaScript'>alert('Не удается подключиться к базе данных. Повторите попытку позже.'),history.go(-1)/script>/html>");
mysql_set_charset("utf8");
mysql_select_db($dbname);
?>