<?php

global $flag;
global $db;
require "flag.php";
require "db.php";

$id= $_GET['id'];
if (!is_null($id)){
    $sql = "select id,username,password from ctf.user where id=".$id;
//    echo $sql;
    $row = $db->query($sql);
    if ($row->num_rows > 0){
        $infos = "id 存在";
    }else{
        $error_message = "id 不存在";
    }
}
// 关闭连接
$db->close();
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

<!--<hint> ?id=? </hint>-->
<?php
// 如果有错误消息，显示出来
if (isset($infos)) {
    echo "<p style='color:green;'>$infos</p>";
}
?>
</body>
</html>
