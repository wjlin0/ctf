#!/usr/bin/env sh
sleep 1


# 修改 secure_file_priv 允许读写




default_flag="flag{********************************}"
custom_flag="${FLAG:-$default_flag}"
echo "$custom_flag" > "/flag"

export FLAG=not_here
rm -f /flag.sh