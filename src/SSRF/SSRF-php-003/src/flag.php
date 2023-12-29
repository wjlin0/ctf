<?php
$flag = "flag{********************************}";


// List of allowed IP addresses
$allowedIPs = array('127.0.0.1', '::1'); // Add more IPs as needed

// Get the client's IP address
$clientIP = $_SERVER['REMOTE_ADDR'];

// Check if the client's IP is in the allowed list
if (in_array($clientIP, $allowedIPs)) {
    echo $flag;
}else{
    echo "you are not allowed to access this page";
}