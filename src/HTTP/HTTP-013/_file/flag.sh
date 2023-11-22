#!/usr/bin/env bash
sleep 1


flagfile=/var/www/html/flag.php
passwordfile=/var/www/html/password.txt

# 生成100个长度为4的随机字符串
for i in {1..100}; do
    random_string=$(cat /dev/urandom | tr -dc 'a-zA-Z0-9' | fold -w 4 | head -n 1)
    echo "$random_string" >> $passwordfile
done

# 从生成的字符串中随机选一个作为custom_password
custom_password=$(shuf -n 1 password.txt)
sed -i "s/1234/$custom_password/" $flagfile


if [ -f $flagfile ]; then
    # 从环境变量中获取 flag
    custom_flag="$FLAG"
    if [ -n "$custom_flag" ]; then
        sed -i "s/flag{\*\*\**}/$custom_flag/" $flagfile
    fi

fi




export FLAG=not_here
rm -f /flag.sh