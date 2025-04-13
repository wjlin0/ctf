
<?php
# 注册
require_once 'db.php';
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "select * from user where username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $res = $stmt->rowCount();
    if($res > 0){
        echo "用户名已存在";
        exit();
    }
    // pdo
    $sql = "insert into user(username,password,isadmin) values(? , ? , 0)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $password]);

    $res = $stmt->rowCount();
    if($res > 0){
        echo "注册成功";
    }else{
        echo "注册失败";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册</title>
</head>
<body>
<h2>注册</h2>
<form method="post" action="register.php">
    <label for="username">用户名:</label>
    <input type="text" id="username" name="username" required><br>
    <label for="password">密码:</label>
    <input type="password" id="password" name="password" required><br>
    <input type="submit" value="注册">
</body>
</html>
