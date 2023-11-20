<?php

!isset($_SESSION) AND die("Direct access on this script is not allowed!");
include 'db.php';

$sql = 'SELECT `username`,`password` FROM `ptbctf`.`ptbctf` where `username`="' . $_GET['username'] . '" and password="' . md5($_GET['password']) . '";';
$result = $con->query($sql);

function auth($user)
{
    $_SESSION['username'] = $user;
    return True;
}

($result->num_rows > 0 AND $row = $result->fetch_assoc() AND $con->close() AND auth($row['username']) AND die('<meta http-equiv="refresh" content="0; url=?p=home" />')) OR ($con->close() AND die('Try again!'));

?>