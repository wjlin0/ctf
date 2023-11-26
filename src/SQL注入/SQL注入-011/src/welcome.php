<?php
require "flag.php";
session_start();

// 检查用户是否已登录
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // 如果未登录，重定向到登录页面
    exit();
}

$user_id = $_SESSION['user_id'];

// 获取管理员状态
$is_admin = ($_SESSION['is_admin'] == 1);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h2>Welcome, User ID: <?php echo $user_id; ?>!</h2>

    <?php
    // 判断是否为管理员
    if ($is_admin) {
        echo "<p>You are an administrator. $flag</p>";
    }
    ?>

    <p>This is the welcome page.</p>

    <a href="change_password.php">Change Password</a> <!-- 链接到修改密码页面 -->

    <br><br>

    <a href="logout.php">Logout</a> <!-- 链接到注销页面 -->
</body>
</html>