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

        $url = addslashes($url);
        $command = "curl \"" . $url."\" --output - -k --max-time 2";
        $handle = popen($command, "r");
        $buffers = "";

// 读取输出
        if ($handle) {
            while (!feof($handle)) {
                $buffer = fgets($handle);
                $buffers .= $buffer;
            }
            pclose($handle);
        }
        return $buffers;
    }
    ?>



</div>
<!--<p> flag in redis </p>-->
</body>
</html>