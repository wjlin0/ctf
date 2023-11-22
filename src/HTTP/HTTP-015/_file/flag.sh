#!/usr/bin/env bash
sleep 1


flagfile=/var/www/html/flag.php
passwordfile=/var/www/html/password.txt
usernamefile=/var/www/html/username.txt




# 生成100个长度为4的随机字符串
for i in {1..100}; do
    random_string=$(cat /dev/urandom | tr -dc 'a-zA-Z0-9' | fold -w 4 | head -n 1)
    echo "$random_string" >> $passwordfile
done


# 从生成的字符串中随机选一个作为custom_password
custom_password=$(shuf -n 1 $passwordfile)
sed -i "s/1234/$custom_password/" $flagfile


# 生成4个长度为4的随机用户名
for i in {1..4}; do
    random_username=$(cat /dev/urandom | tr -dc 'a-z' | fold -w 4 | head -n 1)
    # shellcheck disable=SC2086
    echo $random_username >> $usernamefile
done

# 从生成的字符串中随机选一个作为custom_username
custom_username=$(shuf -n 1 $usernamefile)
sed -i "s/admin/$custom_username/" $flagfile



if [ -f $flagfile ]; then
    # 从环境变量中获取 flag
    custom_flag="$FLAG"
    if [ -n "$custom_flag" ]; then
        sed -i "s/flag{\*\*\**}/$custom_flag/" $flagfile
    fi

fi




export FLAG=not_here
rm -f /flag.sh