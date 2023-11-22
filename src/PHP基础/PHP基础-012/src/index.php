<?php

global $flag;
require "flag.php";
error_reporting(0);
highlight_file(__FILE__);

if (!isset($_GET["md5_1"]) || !isset($_GET["md5_2"])){
    die();
}
$md5_1=$_GET['md5_1'];
$md5_2 = $_GET['md5_2'];
if (($md5_1 != $md5_2) && (md5($md5_1) == md5($md5_2)) )  {
    echo $flag;
}