#!/usr/bin/env sh
sleep 1
# 设置定时任务
echo "*/1 * * * * cd /var/www/html/uploads; tar zcvf /backup.tar.gz *" > /etc/crontab
bash -c 'crond -b && crontab /etc/crontab'
# 设置flag
default_flag="flag{********************************}"
custom_flag="${FLAG:-$default_flag}"
echo $custom_flag > /flag
# 设置flag为其他用户不可读不可读
chown root:root /flag
chmod 400 /flag
export FLAG=not_here
rm -f /flag.sh