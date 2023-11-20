<?php

!isset($_SESSION) AND die("Direct access on this script is not allowed!");
include 'db.php';

(preg_match('/(a|d|m|i|n)/', strtolower($_POST['username'])) OR strlen($_POST['username']) < 6 OR strlen($_POST['username']) > 10 OR !ctype_alnum($_POST['username'])) AND $con->close() AND die("Not allowed!");

$sql = 'INSERT INTO `ptbctf`.`ptbctf` (`username`, `password`) VALUES ("' . $_POST['username'] . '","' . md5($_POST['password']) . '")';

($con->query($sql) === TRUE AND $con->close() AND die("The user was created successfully!")) OR ($con->close() AND die("Error!"));

?>