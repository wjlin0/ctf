#!/usr/bin/env bash
sleep 1


custom_flag=${FLAG:-flag{********************************}}


randomNumber=$((RANDOM % 101))
flagfile="/var/www/html/$randomNumber.jpg"

echo "$custom_flag" > "$flagfile"

export FLAG=not_here
rm -f /flag.sh