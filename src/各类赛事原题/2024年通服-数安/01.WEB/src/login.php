<?php
require 'db.php';
// 如果表单提交
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // 查询用户
  $sql = "SELECT * FROM user WHERE username = :username";
  $stmt = $pdo->prepare($sql);
  // 绑定参数
  $stmt->bindParam(':username', $username);
  $stmt->execute();

  // 获取结果
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // 验证用户是否存在以及密码是否正确
  if ($user && $password=== $user['password']) {
    // 登录成功
    echo "登录成功！欢迎, " . htmlspecialchars($username);
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['isadmin'] = $user['isadmin'];
    if ($_SESSION['isadmin'] == '1'){
      header('Location: admin.php');
    } else {
      header('Location: index.php');
    }
  } else {
    // 登录失败
    echo "用户名或密码错误。";
  }
}

echo "<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>登陆</title>
</head>
<body>
<h2>登陆</h2>
<form method=\"post\" action=\"login.php\">
    <label for=\"username\">用户名:</label>
    <input type=\"text\" id=\"username\" name=\"username\" required><br>
    <label for=\"password\">密码:</label>
    <input type=\"password\" id=\"password\" name=\"password\" required><br>
    <input type=\"submit\" value=\"登陆\">
</form>
</html>"

?>
