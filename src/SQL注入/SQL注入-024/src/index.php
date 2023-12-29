<?php
global $db;
require "db.php";

$infos = NULL;
$sort = $_GET['sort'];
if (!is_null($sort)) {
    $sql = "SELECT * FROM users ORDER BY $sort";
    $result = pg_query($db, $sql);

    if ($result) {
        while ($row = pg_fetch_assoc($result)) {
            // 处理每一行
            if (is_array($row)) {
                if (is_null($infos)) {
                    $infos = array();
                }
                $infos[] = $row;
            }
        }
        pg_free_result($result);
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
if (!is_null($infos)) {
    foreach ($infos as $k => $v) {
        if (is_array($v)) {
            foreach ($v as $vk => $vv) {
                echo "<hr/><p style='color:green;'>$vk: $vv</p>";
            }
        } else {
            echo "<hr/><p style='color:green;'>$k: $v</p>";
        }
    }
}
?>
<!--<hint> ?sort=? </hint>-->