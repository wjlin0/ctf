<?php
highlight_file(__FILE__);
global $flag;
require "flag.php";

$f = isset($_REQUEST["flag"]) ? $_REQUEST["flag"] : null;

if (isset($f) && is_array($f) && $f[0] === "nalai") {
    echo $flag;
}