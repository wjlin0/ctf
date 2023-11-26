<?php
session_start();

// 检查用户是否已登录
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // 如果未登录，重定向到登录页面
    exit();
}
// 包含数据库连接文件
include('db.php');
global $db;
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION["username"];
// 处理修改密码请求
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取用户输入的旧密码和新密码
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    if ($oldPassword != $_SESSION["password"]){
        die("error old passwod");
    }
    $hashPassword = md5($newPassword);

    $sql = "UPDATE user SET password = '$hashPassword' WHERE username='$user_name'";
    echo $sql;
    $db->query($sql);
    // 退出登录状态
    session_destroy();

    // 重定向到登录页面
//    header("Location: index.php");
    exit(); // 这里可以重定向到其他页面或执行其他逻辑
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
<h2>Change Password</h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="old_password">Old Password:</label>
    <input type="password" id="old_password" name="old_password" required><br>

    <label for="new_password">New Password:</label>
    <input type="password" id="new_password" name="new_password" required><br>

    <input type="submit" value="Change Password">
</form>

<br>

<a href="welcome.php">Back to Welcome</a> <!-- 链接回欢迎页面 -->
</body>
</html>