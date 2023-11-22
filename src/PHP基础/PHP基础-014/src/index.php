<?php

global $flag;
require "flag.php";
highlight_file(__FILE__);

if (!isset($_GET["md5"])){
    die();
}
$md5=$_GET['md5'];
if ($md5 == md5($md5)){
    echo $flag;
}