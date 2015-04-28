<?php//functions.php
//主要功能的包含文件
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2015-03-26 21:09:51
 * @version $Id$
 */
$dbhost='localhost';             //主机；
$dbname='personnalWeb';          //数据库名；
$dbuser='root';                  //用户名;
$dbpass='wang834379220';         //使用数据库的密码;
$appname='Mr Wang Personal Web'; //项目名;

mysql_connect($dbhost,$dbuser,$dbpass) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());

function createTable($name,$content){
	//$name,table的名字;
	//$content,table的列;
	queryMysql("CREATE TABLE IF NOT EXITS $name($content)") or die("CREATE TABLE".mysql_error());
}

//SQL语句执行函数
function queryMysql($query){
	//$query,是SQL语句;
	$result=mysql_query($query) or die(mysql_error());
	return $result;
}

function destorySession(){
	$_SESSION=array();
	if(session_id() !="" || isset($_COOKIE[session_name()]))
		setcookie(session_name(),'',time()-2592000,'/');
	session_destroy();
}

//规范化字符串函数
function sanitizeString($var){
	$var=strip_tags($var);
	$var=htmlentities($var);
	$var=stripcslashes($var);
	return mysql_real_escape_string($var);
}
?}