<?php

global $flag;
require "flag.php";
highlight_file(__FILE__);
if(preg_match("wjlin0",$_GET["name"])) {
    die("hacker!!!!!!!!");

}

if(urldecode($_GET["name"]) == "wjlin0"){
    echo $flag;
}
?>