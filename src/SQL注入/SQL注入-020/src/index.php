<?php
global $db;
require "db.php";

$id = $_GET['id'];
$infos = NULL;

if (!is_null($id)) {
    $sql = "SELECT * FROM users WHERE id = ($id)";
    $result = pg_query($db, $sql);
    $row = pg_fetch_assoc($result);
    if ($row) {
        $infos = "id 存在";
    } else {
        $error_message = "id 不存在";
    }
}

// 关闭连接
pg_close($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER INFO</title>
</head>
<body>
<h2>USER INFO</h2>

<?php
// 如果有错误消息，显示出来
if (isset($error_message)) {
    echo "<p style='color:red;'>$error_message</p>";
}
?>
<?php
// 如果有查询结果，显示出来
if (!is_null($infos)){
    echo "<p style='color:green;'>$infos</p>";
}
?>
<!--<hint> ?id=? </hint>-->