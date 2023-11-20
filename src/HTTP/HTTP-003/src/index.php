<h1>
    请用管理员 username = admin 登录
</h1>
<?php
if(isset($_COOKIE['username']) && $_COOKIE['username'] == 'admin') {
    echo "flag{********************************}";
} 

?>