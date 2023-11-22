<?php

global $flag;
require "flag.php";
highlight_file(__FILE__);
error_reporting(0);

$username = $_GET["username"];

if(preg_match("/admin/i",$username)){
    die("hacker!hacker!hacker!");
}

if (strpos($username,"admin") !== false){
    echo $flag;
}
