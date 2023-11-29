#!/usr/bin/env sh
sleep 1


default_flag="flag{********************************}"
custom_flag="${FLAG:-$default_flag}"


randomNumber=$((RANDOM % 101))
flagfile="/var/www/html/$randomNumber.jpg"

echo "$custom_flag" > "$flagfile"

export FLAG=not_here
rm -f /flag.sh