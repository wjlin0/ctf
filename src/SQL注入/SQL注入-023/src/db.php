<?php
// 数据库连接参数
$host = "127.0.0.1";
$port = 5432;
$user = "postgres";
$database = "ctf";

// 尝试连接到 PostgreSQL
$db = pg_connect("host=$host port=$port user=$user dbname=$database");

// 检查连接是否成功
if (!$db) {
    die("Failed to connect to PostgreSQL.\n");
}
