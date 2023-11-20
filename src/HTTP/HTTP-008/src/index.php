<?php

$flag = "flag{********************************}";

$XFFHeaderValue = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '';

if ($XFFHeaderValue ==="localhost" || $XFFHeaderValue ==="127.0.0.1"){
    echo $flag;
}else {
    echo "<h1>请本地(XFF)访问</h1>";
}
