<?php
highlight_file(__FILE__);

if (!isset($_GET['info'])) {
    die("where is the info?");
}
$info = $_GET['info'];
if ($info==="phpinfo"){
    phpinfo();
    die();
}
$info = base64_decode($info);

$object = unserialize($info);

class Show {
    public $show;
    public function __destruct() {
        eval($this->show);
    }
}