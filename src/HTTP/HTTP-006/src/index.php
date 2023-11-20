<?php
$ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
if (strpos($ref, 'flag.com') === false){
    header("HINT: referer flag.com");
}else{
    header("FLAG: flag{********************************}");
}
