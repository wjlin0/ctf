<?php

global $flag;
global $db;
require "flag.php";
require "db.php";

$username= $_POST['username'];
$password = $_POST["password"];

if (($_SERVER["REQUEST_METHOD"] == "POST") && !is_null($username)){
    $sql = "select * from ctf.user where username='".$username."' and password=".md5($password);
//    echo $sql;
    $row = $db->query($sql);
    if ($row->num_rows > 0){
        echo $flag;
    }else{
        $error_message = "用户名或密码错误";
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
    <title>Login</title>
</head>
<body>
<h2>Login</h2>

<?php
// 如果有错误消息，显示出来
if (isset($error_message)) {
    echo "<p style='color:red;'>$error_message</p>";
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>

    <input type="submit" value="Login">
</form>
</body>
</html>
