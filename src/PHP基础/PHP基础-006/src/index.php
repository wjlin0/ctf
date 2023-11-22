<?php

error_reporting(0);
require 'flag.php';
highlight_file(__FILE__);
function noother_says_correct($temp)
{
    global $flag;
    $one = ord('1');
    $nine = ord('9');
    $number = '3735929054';
    // Check all the input characters!
    for ($i = 0; $i < strlen($number); $i++) {
        // Disallow all the digits!
        $digit = ord($temp{$i});
        if (($digit >= $one) && ($digit <= $nine)) {
            // Aha, digit not allowed!
            return "flase";
        }
    }
    if ($number == $temp)
        return $flag;
}

echo noother_says_correct($_GET['password']);
