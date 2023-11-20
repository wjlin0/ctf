<?php


if ($_SERVER["REQUEST_METHOD"] !== "POST" ){
    die("Invalid request.");
}  

$json_data = file_get_contents("php://input");
$data = json_decode($json_data, true);
if ($data === null) {
    die("json error");
}

if ($data["flag"] === null  || $data["flag"] === "") {
    die("flag is null");
}
if (is_numeric($data["flag"]) === FALSE) {
    die("flag is not numer");
}
if ($data["flag"] == 1) {
    die("flag{is_not_me}");
}
if ($data["flag"] == 2) {
    die("flag{********************************}");
}