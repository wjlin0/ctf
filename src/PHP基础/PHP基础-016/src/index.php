<?php

global $flag;
require "flag.php";
highlight_file(__FILE__);
error_reporting(0);

$username=$_GET['username'];


if( $username != "admin" && preg_match('/^admin$/i', $username)){
    echo $flag;
}
