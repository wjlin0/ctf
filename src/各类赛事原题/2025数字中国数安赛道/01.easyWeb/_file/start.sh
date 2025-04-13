#!/bin/bash

# 启动MySQL服务
mysqld_safe & 

# 等待MySQL服务完全启动
while ! mysqladmin ping -h localhost --silent; do
    sleep 1
done

if [[ -f /app/db.sql ]]; then
    mysql -e "source /app/db.sql" -uroot -proot
    rm -f /app/db.sql
fi
# 启动Flask应用
cd /app
python3 app.py