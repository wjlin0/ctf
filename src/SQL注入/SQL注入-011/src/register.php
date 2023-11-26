<?php
require "db.php";
global $db;
// 处理用户提交的注册表单
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // 在这里执行用户注册逻辑，例如验证输入、检查用户名是否唯一，然后将用户信息插入数据库
    // 验证密码是否匹配
    if ($password !== $confirmPassword) {
        echo "Passwords do not match.";
        exit();
    }

    // 检查用户名是否已存在
    $checkStmt = $db->prepare("SELECT id FROM user WHERE username = ?");
    $checkStmt->bind_param("s", $username);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo "Username already exists.";
        exit();
    }

    $checkStmt->close();

    // 插入新用户
    $hashedPassword = md5($password);

    $insertStmt = $db->prepare("INSERT INTO user (username, password) VALUES (?, ?)");

    $insertStmt->bind_param("ss", $username, $hashedPassword);

    $insertStmt->execute();

    $insertStmt->close();

    echo "Registration successful.<br>";



    // 示例中简单地输出一些信息
    echo "Username: $username<br>";
    echo "Password: $password<br>";
    echo "Confirm Password: $confirmPassword<br>";
    exit(); // 这里可以重定向到其他页面或执行其他逻辑
    // 注册成功后重定向到登录页面
//    header("Location: index.php");
//    exit(); // 这里可以重定向到其他页面或执行其他逻辑
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<h2>Register</h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required><br>

    <input type="submit" value="Register">
</form>

<br>

<a href="index.php">Already have an account? Login here</a> <!-- 链接到登录页面 -->
</body>
</html>