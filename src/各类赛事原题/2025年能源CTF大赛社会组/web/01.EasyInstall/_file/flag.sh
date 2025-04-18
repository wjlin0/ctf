default_flag="flag{********************************}"
custom_flag="${FLAG:-$default_flag}"
echo $custom_flag > /readflag
chmod 444 /readflag
export FLAG=not_here
rm -f /flag.sh