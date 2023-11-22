<?php

global $flag;
require "flag.php";
highlight_file(__FILE__);
if(preg_match("knownsec",$_GET["name"])) {
    die("hacker!!!!!!!!");

}

if(urldecode($_GET["name"]) == "knownsec"){
    echo $flag;
}
?>