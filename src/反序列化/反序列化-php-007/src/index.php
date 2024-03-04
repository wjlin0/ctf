<?php

highlight_file(__FILE__);
error_reporting(0);
if (!isset($_GET['info'])) {
    die("where is the info?");
}
$info = $_GET['info'];

if ($info==="phpinfo"){
    phpinfo();
    die();
}



$info = base64_decode($info);

if (errorUnserializeStr($info)){
    die("no unserialize!");
}

$object = unserialize($info);

//var_dump($object)."</br>";

class Show {
    public $show;
    public function __destruct() {
        eval($this->show);
    }
}

function errorUnserializeStr($str): bool
{
    if (preg_match('/^[ao]/i', $str)){
        return true;
    }
    return false;
}