<?php
session_start(); // 启动会话
require "db.php";


// 检查连接是否成功
if ($db->connect_error) {
    die("连接失败: " . $db->connect_error);
}

// 检查用户是否提交了登录表单
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 从登录表单获取用户名和密码
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 使用预处理语句防止 SQL 注入
    $stmt = $db->prepare("SELECT id, username, password FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($userId, $dbUsername, $dbPassword);
    $stmt->fetch();
    $stmt->close();

    // 验证密码
    if (md5($password) === $dbPassword) {
        // 用户验证成功，设置会话变量
        $_SESSION['user_id'] = $userId;
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;
        if ($_SESSION['user_id'] === 0){
            $_SESSION["is_admin"] = 1;
        }else{
            $_SESSION["is_admin"] = 0;
        }
        // 重定向到用户登录后的页面
        header("Location: welcome.php");
        exit();
    } else {
        // 用户验证失败，显示错误消息
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
<a href="register.php">register</a> <!-- 链接回欢迎页面 -->
</body>
</html>