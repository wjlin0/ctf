<?php

require "flag.php";
global $flag,$password,$username;

echo "<a href='/password.txt'>password</a><hr/><a href='/username.txt'>username</a><hr/>";


$user = $_POST["username"];
$pass = $_POST["passowrd"];
if ($user === $username && $pass === $password){
    echo $flag;
}else {
    echo "<h1>error username,password<hr/>  </h1>>";
}



