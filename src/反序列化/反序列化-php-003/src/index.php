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


class ZhangSan {
    public $name;
    public function __invoke()
    {
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
}

