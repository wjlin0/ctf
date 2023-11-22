<?php
global $flag;
require 'flag.php';
highlight_file(__FILE__);
$num = $_GET["num"];
if (is_numeric($num)){
    die("error num = $num");
}
if ($num == "1") {
    echo $flag;
}
