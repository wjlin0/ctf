<?php

global $flag;
require "flag.php";
highlight_file(__FILE__);

if(isset($_GET['num'])){

    $num = $_GET['num'];

    if($num==2023){

        die("no no no!");

    }

    if(preg_match("/[a-z]|\./i", $num)){

        die("no no no!!");

    }

    if(strpos($num, "0") === false){

        die("no no no!!!");

    }

    if(intval($num,0)===2023){

        echo $flag;

    }

}
