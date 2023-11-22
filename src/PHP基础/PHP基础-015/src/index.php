<?php

global $flag;
require "flag.php";
highlight_file(__FILE__);


$config_array = array(
    "1","2","3","4",5
);


$size = $_GET["size"];

if (!in_array($size,$config_array)){
    die("hack!hack!hack!");
}
system("ping -c $size 127.0.0.1");