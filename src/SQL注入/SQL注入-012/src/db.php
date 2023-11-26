<?php
$dbname = "ctf";
$dbhost = "127.0.0.1";
$dbport = 3306;
$dbuser = "root";
$dbpass = "root";


$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname,$dbport);
$db->query("SET NAMES gbk");
