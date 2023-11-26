<?php

global $flag;
global $db;
require "flag.php";
require "db.php";

$id= $_GET['id'];
$usernames = NULL;
$passwords = NULL;
if (!is_null($id)){
    $sql = "select id,username,password from ctf.user where id=\"".$id."\"";
//    echo $sql;
    $row = $db->query($sql);
    if ($row->num_rows > 0){

        $row = $row->fetch_all();
        foreach ($row as $k=>$v){
                $temp = array(
                    "username"=>$v[1],
                    "password"=>$v[2],
                );
                if (is_null($usernames)){
                    $usernames = array();
                }
                $usernames[] = $temp;
            }

        $username = $row["username"];
        $password = $row["password"];
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
if (!is_null($usernames)) {
    foreach ($usernames as $k =>$v){
        echo "<hr/><p style='color:green;'>".$v["username"]."</p>";
        echo "<hr/><p style='color:green;'>".$v["password"]."</p>";
    }
}
?>
</body>
</html>
