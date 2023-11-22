#!/usr/bin/env bash
sleep 1


# shellcheck disable=SC2034
flagfile=/flag
# shellcheck disable=SC2034
custom_flag=${FLAG:-flag{********************************}}
echo "$FLAG" > /flag



export FLAG=not_here
rm -f /flag.sh