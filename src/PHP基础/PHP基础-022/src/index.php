<?php
global $flag;
require "flag.php";
highlight_file(__FILE__);
error_reporting(0);
$username = "admin";
extract($_GET["password"]);

if ($username != "admin"){
    echo $flag;
}