<?php
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "GET"){
    header("HINT: OTPIONS, POST, PUT, DELETE");
}
if ($method == "POST"){
    header("FLAG: flag{********************************}");
}
