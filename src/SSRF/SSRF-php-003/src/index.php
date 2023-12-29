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
        // 判断url 是否以 http 开头
        if ((strpos($url, 'http://') ===0) === false) {
            return "you are not allowed to access this page";
        }
        // 正则 判断 url 中 是否 有 127.
        var_dump(
            preg_match('/127\./', $url)
        );
        if (preg_match('/127\./', $url) || preg_match('/localhost/', $url)) {
            return "you are not allowed to access this page";
        }

        // Use cURL to make a request to the entered URL

        return file_get_contents($url);
    }
    ?>
</div>
<!--<p> flag in /flag.php </p>-->
</body>
</html>