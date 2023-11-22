<?php

highlight_file(__FILE__);
error_reporting(-1);

$username = $_POST["username"];
if (is_array($username)){
    die("hacker!hacker!hacker!");
}
if(preg_match("/<\?.*[(`;?>].*/",$username)){
    die("hacker!hacker!hacker!");
}
@file_put_contents("shell.php",$username);
