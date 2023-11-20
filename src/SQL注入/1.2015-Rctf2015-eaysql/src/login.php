<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");
require_once 'config.php';


if(isset($_POST['username']) && isset($_POST['password'])){
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$sql = "SELECT * FROM users WHERE name = '$username' and pwd = '$password'";
	$query = mysqli_query($conn,$sql);
	if(mysqli_num_rows($query) == 1){
		$row = mysqli_fetch_array($query);
		$_SESSION['username'] = $row['name'];
		header('Location: index.php');
		die();
	}else{
		die('<br>login error');
	}
}else{
    echo '<form action="login.php" method="post"><p>username: <input type="text" name="username" /></p><p>password: <input type="text" name="password" /></p><input type="submit" value="Submit" /></form>';
}
?>