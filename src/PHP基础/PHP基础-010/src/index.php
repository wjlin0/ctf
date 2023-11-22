<?php

global $flag;
require "flag.php";
highlight_file(__FILE__);
$num = $_GET["num"];
if(intval($num) < 2023 && intval($num + 1) > 2024){
    echo $flag;
}
