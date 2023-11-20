<?php

require "flag.php";


$remoteIpAddress = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
if ($remoteIpAddress === '127.0.0.1') {
    die("FLAG: $flag");
}else{
    highlight_file(__FILE__);
}