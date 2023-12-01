<?php
require "db.php";
global $conn;
if ($_GET["flag"] === "1"){
    // 执行查询或其他数据库操作
    $result = pg_query($conn, "SELECT * FROM flag");
    while ($row = pg_fetch_assoc($result)) {
        print_r($row);
    }
    // 关闭数据库连接
    pg_close($conn);
}
