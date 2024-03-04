#!/usr/bin/env sh
sleep 1

# shellcheck disable=SC2034
flagfile=/flag
# shellcheck disable=SC2034
default_flag="flag{********************************}"
custom_flag="${FLAG:-$default_flag}"
echo "$custom_flag" > /flag

export FLAG=not_here
rm -f /flag.sh