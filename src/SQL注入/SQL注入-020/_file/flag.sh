#!/usr/bin/env sh
sleep 1


custom_flag="$FLAG"
if [ -n "$custom_flag" ]; then
   psql -U postgres -d ctf -c "UPDATE flag SET flag = '$FLAG';"
fi

export FLAG=not_here
rm -f /flag.sh