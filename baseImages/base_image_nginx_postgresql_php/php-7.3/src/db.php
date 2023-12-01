<?php

// 数据库连接参数
$host = "localhost";
$port = 5432;
$user = "postgres";
$database = "ctf";

// 尝试连接到 PostgreSQL
$conn = pg_connect("host=$host port=$port user=$user dbname=$database");

// 检查连接是否成功
if (!$conn) {
    die("Failed to connect to PostgreSQL.\n");
}
?>
