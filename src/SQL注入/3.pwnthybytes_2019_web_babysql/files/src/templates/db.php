<?php

$servername = $_ENV["DB_HOST"] ?: "127.0.0.1";
$username = $_ENV["DB_USER"] ?: "root";
$password = $_ENV["DB_PASSWORD"]? :"root";
$dbname = $_ENV["DB_NAME"]?: "ptbctf";

$con = new mysqli($servername, $username, $password, $dbname);
$sql = "INSERT INTO `flag_tbl` (secret) SELECT '" . file_get_contents("/flag") . "' FROM DUAL WHERE NOT EXISTS(SELECT secret FROM flag_tbl);";
$result = $con->query($sql);


