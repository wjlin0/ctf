#!/usr/bin/env sh
sleep 1


default_flag="flag{********************************}"
custom_flag="${FLAG:-$default_flag}"

echo -n "$custom_flag" > /flag
chmod 400 /flag
chown root:root /cat_flag
chmod 4755 /cat_flag



export FLAG=not_here
rm -f /flag.sh