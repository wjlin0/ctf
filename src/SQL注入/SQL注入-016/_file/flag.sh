#!/usr/bin/env sh
sleep 1



flagfile=/var/www/html/db.sql

if [ -f $flagfile ]; then
    # 从环境变量中获取 flag
    custom_flag="flag{not_here}"
    if [ -n "$custom_flag" ]; then
        sed -i "s/flag{\*\*\**}/$custom_flag/" $flagfile
    fi
fi


default_flag="flag{********************************}"
custom_flag="${FLAG:-$default_flag}"

echo -n "$custom_flag" > /flag
chmod 400 /flag
chown root:root /cat_flag
chmod u+x /cat_flag



export FLAG=not_here
rm -f /flag.sh