<?php
session_start();

// 销毁当前会话
session_destroy();

// 重定向到登录页面
header("Location: index.php");
exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>
<h2>You have been logged out</h2>
<p>If you are not automatically redirected, <a href="login.php">click here</a>.</p>
</body>
</html>
