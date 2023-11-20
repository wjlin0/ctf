<?php

$flag = "flag{********************************}";
header("HINT: hint.php");
header("HINT2: index.php?url=*");


$ch = curl_init(); // 初始化 cURL
$url = $_GET["url"]; // 请求的URL
if ($url === "") {
    die();
}
// 设置 cURL 选项
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // 返回响应而不直接输出
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 忽略 SSL 证书验证

// 执行 cURL 请求并获取响应
$response = curl_exec($ch);

// 检查是否有错误发生
if(curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
}

// 关闭 cURL 资源
curl_close($ch);

// 输出响应
echo $response;


