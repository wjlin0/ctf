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
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url); // 设置访问的URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 以文件流的形式返回
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // 跟随重定向
        curl_setopt($ch, CURLOPT_TIMEOUT, 5); // 设置超时限制，防止卡死

        $output = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // 获取HTTP状态码

        curl_close($ch); // 关闭cURL资源

        if ($httpCode == 200) {
            // 如果HTTP状态码为200，返回内容
            return $output;
        } else {
            // 如果URL不存在或无法访问，返回不存在信息
            return "URL 不存在或无法访问";
        }

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
<!--<p> flag not here. Do you want to try web scraping ?</p>-->
</body>
</html>