<?php
global $flag;
require "flag.php";
highlight_file(__FILE__);
error_reporting(0);

$username = $_GET["username"];

$username = preg_replace('/.*/e','\0',$username);
if ($username  === '\0'){
    echo $flag;
}
