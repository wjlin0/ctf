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

$object = unserialize($info);

//var_dump($object)."</br>";


class ZhangSan {
    public $name;
    public function __invoke()
    {
//        var_dump($this->name);
        return eval($this->name);
    }


}

class User {
    public $username;
    public function __toString()
    {
        $tmp = $this->username;

        return $tmp();
    }
}


class Show {
    public $show;
    public function __destruct() {
        echo $this->show;
    }
    public function __wakeup() {
       $this->show = new User();
       $this->show->username = new ZhangSan();
       $this->show->username->name = "echo 'hello,world!';";
    }
}

