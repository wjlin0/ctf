<h1>
    请用浏览器标识 user_agent = knownsec 访问
</h1>
<?php
if(isset($_SERVER['HTTP_USER_AGENT']) && $_SERVER['HTTP_USER_AGENT'] == 'knownsec') {
    echo "flag{********************************}";
} 

?>