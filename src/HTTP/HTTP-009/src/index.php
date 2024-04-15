<?php

$flag = "flag{********************************}";

if($_COOKIE['username'] !== 'admin') {
   die("<h1>请用管理员(admin)登录</h1>");
} 

if ($_SERVER['REQUEST_METHOD'] !== "POST"){
    die("<h1>请用POST访问</h1>");
}

if ($_SERVER["HTTP_USER_AGENT"] !== "wjlin0"){
    die("请用浏览器标识 wjlin0 访问!");
}

if (strpos($_SERVER['HTTP_REFERER'], 'flag.com') === false){
    die("<h1>HINT: referer flag.com</h1>");
}



$XFFHeaderValue = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '';

if (($XFFHeaderValue ==="localhost" || $XFFHeaderValue ==="127.0.0.1")===FALSE){
    die("<h1>请本地(XFF)访问</h1>");
}


echo $flag;

