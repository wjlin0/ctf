<?php
require "flag.php";
global $flag;
error_reporting(0);
highlight_file(__FILE__);

if (isset ($_GET['password'])) {
    if (preg_match ("/^[a-zA-Z0-9]+$/", $_GET['password']) === FALSE)
        echo 'You password must be alphanumeric';
    else if (strpos ($_GET['password'], '--') !== FALSE)
        die('Flag: ' . $flag);
    else
        echo 'Invalid password';
}
?>