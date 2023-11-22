<?php

require "flag.php";
global $flag,$password,$username;
header("HINT: username=admin&password=? post");
header("HINT2: /password.txt ?");
$user = $_POST["username"];
$pass = $_POST["passowrd"];
if ($user === $username && $pass === $password){
    echo $flag;
}else {
    echo "<h1>error username,password<hr/> <a href='/password.txt'>?</a>> </h1>>";
}



