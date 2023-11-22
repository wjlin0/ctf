<?php

global $flag;
require "flag.php";
error_reporting(0);
highlight_file(__FILE__);

if (!$_FILES) {
    die("no md5 file");
}
$file1Content = file_get_contents($_FILES['md5_1']['tmp_name']);
$md5Hash1 = md5($file1Content);

$file2Content = file_get_contents($_FILES['md5_2']['tmp_name']);
$md5Hash2 = md5($file2Content);


if ($file2Content !== $file1Content && $md5Hash2 === $md5Hash1){
    echo $flag;
}