<?php
global $flag;
require "flag.php";
error_reporting(0);
$password = trim($_REQUEST['password'] ?? '');
$name = trim($_REQUEST['name'] ?? 'viewsource');
function viewsource() {show_source(__FILE__);}
if (strcmp(hash('sha256', $password), 'ca572756809c324632167240d208681a03b4bd483036581a6190789165e1387a') === 0) {
    function readflag() {
        global $flag;
        echo $flag;
    }
}

$name();
?>