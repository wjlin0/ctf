<?php
$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = 'root';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

mysqli_select_db($conn,'web_sqli');
mysqli_query($conn,'set NAMES utf8');

if (!get_magic_quotes_gpc()){
	foreach($_POST as $key => $value){
		$_POST[$key] = addslashes($value);
	}
	foreach($_GET as $key => $value){
		$_GET[$key] = addslashes($value);
	}
}
?>