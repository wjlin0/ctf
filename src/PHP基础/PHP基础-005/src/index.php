<?php
global $flag;
require 'flag.php';
//$decodeText = htmlentities($flag, ENT_QUOTES, 'UTF-8');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Entity Decoding Example</title>
</head>
<body>

<div>
<!--
    <?php
function base32_encode($data) {
    $base32Chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    $base32 = '';
    $binary = '';

    // 将字符串转换为二进制
    foreach (str_split($data) as $char) {
        $binary .= str_pad(base_convert(ord($char), 10, 2), 8, '0', STR_PAD_LEFT);
    }

    // 每5个二进制字符编码为一个Base32字符
    $length = strlen($binary);
    for ($i = 0; $i < $length; $i += 5) {
        $chunk = substr($binary, $i, 5);
        $base32 .= $base32Chars[bindec($chunk)];
    }

    // 如果二进制长度不是5的倍数，添加额外的Base32字符和尾部的 '=' 字符
    $padding = $length % 5;
    if ($padding > 0) {
        $base32 .= str_repeat('=', 5 - $padding);
    }

    return $base32;
}



echo base32_encode(base64_encode($flag)); ?>
    -->
</div>

<script>
alert("flag is here");
alert("flag is here");
alert("flag is here");
alert("flag is here");
alert("flag is here");
alert("flag is here");
alert("flag is here");

</script>
</body>
</html>
