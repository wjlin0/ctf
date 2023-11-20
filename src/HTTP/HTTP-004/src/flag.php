<?php
$flag = "flag{********************************}";
// 设置302 Found状态码
header("HTTP/1.1 302 Found");

// 设置Location头，指定跳转的目标URL
header("Location: /location.php");

echo $flag;


exit;
