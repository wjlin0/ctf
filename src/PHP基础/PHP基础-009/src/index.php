<?php

highlight_file(__FILE__);
error_reporting(0);

$path = '/var/www/html/temp';
mkdir($path);
chdir($path);

if(isset($_GET['filename'])&&isset($_GET['contents'])){
    $filename= $_GET['filename'];
    $contents = $_GET['contents'];
    if (strlen($contents)>2||strlen($filename)>2){
        die("hack!hack!hack!");
    }

    file_put_contents($path.$filename,$contents);
    if (strlen(file_get_contents($filename)) <= 10) {
        system('php '.$path.$filename);
    }

    else{
        system('rm '.$path.$filename);
        die("no!no!no!");
    }
}
else if (isset($_GET['file'])) {
    $filename= $_GET['filename'];
    system('/bin/rm -rf ' . $path . $filename);
}