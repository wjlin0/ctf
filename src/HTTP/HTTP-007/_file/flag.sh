#!/usr/bin/env bash
sleep 1


flagfile=/var/www/html/api/flag.php

if [ -f $flagfile ]; then
    # 从环境变量中获取 flag
    custom_flag="$FLAG"
    if [ -n "$custom_flag" ]; then
        sed -i "s/flag{\*\*\**}/$custom_flag/" $flagfile
    fi
fi
export FLAG=not_here
rm -f /flag.sh