<?php

require "flag.php";
global $flag,$password,$username;

echo "<a href='/password.txt'>password</a><hr/><a href='/username.txt'>username</a><hr/>md5 ?";


$user = $_POST["username"];
$pass = $_POST["password"];
if ($user === $username && md5($password) === $pass){
    echo $flag;
}else {
    echo "<h1>error username,password<hr/>  </h1>>";
}



