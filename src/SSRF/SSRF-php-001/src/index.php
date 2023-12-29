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
        // Use cURL to make a request to the entered URL
//        $ch = curl_init($url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        $result = curl_exec($ch);
//        curl_close($ch);

        return file_get_contents($url);
    }
    ?>
</div>
<!--<p> flag in /flag.php </p>-->
</body>
</html>