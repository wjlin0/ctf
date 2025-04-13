<?php
$dbname = "ctf";
$dbhost = "127.0.0.1";
$dbport = 3306;
$dbuser = "root";
$dbpass = "root";
# 编码
$dbcharset = "utf8mb4";
$dsn = "mysql:host=$dbhost:$dbport;dbname=$dbname;charset=$dbcharset"; // 替换为你的数据库信息


$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname,$dbport);
mysqli_set_charset($db, $dbcharset);

// 创建 PDO 实例
$pdo = new PDO($dsn, $dbuser, $dbpass);
// 设置 PDO 错误模式为异常模式
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
