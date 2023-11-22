<?php
global $flag;
require "flag.php";
error_reporting(0);
$name = trim($_REQUEST['name'] ?? 'viewsource');
function viewsource() {show_source(__FILE__);}
function readflag() {
    global $flag;
    echo $flag;
}
$name();
