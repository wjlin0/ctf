<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Input Page</title>
</head>
<body>

<div style="text-align: center; margin-top: 200px;">
    <form method="post">
        <label for="urlInput">Enter URL:</label>
        <input type="text" name="proxy" id="proxy" placeholder="https://example.com" style="margin-left: 10px;">
        <input type="submit" value="Submit">
    </form>
</div>

<div id="result" style="text-align: center; margin-top: 20px;">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $urlInput = $_POST["proxy"];
        $result = fetchData($urlInput);
        echo '<p>Response from ' . $urlInput . ':</p><pre>' . htmlspecialchars($result) . '</pre>';
    }
    ?>

    <?php
    function fetchData($url) {
        if (check_inner_ip($url))
            //判断url是否是私有地址
        {
            return $url.' is inner ip';
        }
        print_r(parse_url($url));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url); //访问的域名
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //以文件流的形式返回
        $output = curl_exec($ch);
//        $result_info = curl_getinfo($ch);
//        if ($result_info['redirect_url']) {
//            fetchData($result_info['redirect_url']);
//        }
//        curl_close($ch); // 关闭cURL资源，并且释放系统资源
        return $output;

    }
    function check_inner_ip($url) //获取url的域名，将域名转为ip，然后再判断这个ip是否是私有地址
    {
        $match_result=preg_match('/^(http|https)?:\/\/.*(\/)?.*$/',$url);
        if (!$match_result)
        {
           return  'url fomat error';
        //如果url不符合正则表达式
        }
        try {
            $url_parse=parse_url($url);
        } catch(Exception $e) {
            return  'url fomat error';
        }
        $hostname=$url_parse['host'];
//        var_dump(
//                $hostname,"<br>"
//        );
        $ip=gethostbyname($hostname);
        $int_ip=ip2long($ip);
        return ip2long('127.0.0.0')>>24 == $int_ip>>24 || ip2long('10.0.0.0')>>24 == $int_ip>>24 || ip2long('172.16.0.0')>>20 == $int_ip>>20 || ip2long('192.168.0.0')>>16 == $int_ip>>16;

}
    ?>



</div>
<!--<p> flag in /flag.php </p>-->
</body>
</html>