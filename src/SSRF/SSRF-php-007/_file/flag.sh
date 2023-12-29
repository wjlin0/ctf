#!/usr/bin/env sh
sleep 1



default_flag="flag{********************************}"
custom_flag="${FLAG:-$default_flag}"
redis-cli SET flag "$custom_flag"
export FLAG=not_here
rm -f /flag.sh