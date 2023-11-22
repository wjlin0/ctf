<?php
highlight_file(__FILE__);
global $flag;
require "flag.php";
$f = isset($_REQUEST["flag"]) ? $_REQUEST["flag"] : null;
if ($f == "1") echo $flag;