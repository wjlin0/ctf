#!/bin/bash


custom_flag="$FLAG"
if [ -n "$custom_flag" ]; then
   # 修改数据库中的 FLAG
   mysql -e "USE ctf; UPDATE flag SET flag = '$custom_flag';" -uroot -proot >/dev/null 2>&1
fi

export FLAG=not_flag
FLAG=not_flag

rm -f /flag.sh