#!/usr/bin/env sh
sleep 1

# 设置 flag
default_flag="flag{********************************}"
custom_flag="${FLAG:-$default_flag}"

# 数据库配置
mysql_host="127.0.0.1"
mysql_user="root"
mysql_pass="root"
mysql_db="ctf"
mysql_table="flag"

# 创建数据库（如果不存在）
mysql -h"$mysql_host" -u"$mysql_user" -p"$mysql_pass" -e \
"CREATE DATABASE IF NOT EXISTS $mysql_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 创建表（如果不存在）
mysql -h"$mysql_host" -u"$mysql_user" -p"$mysql_pass" -D"$mysql_db" -e \
"CREATE TABLE IF NOT EXISTS $mysql_table (
    id INT AUTO_INCREMENT PRIMARY KEY,
    flag TEXT
);"

# 写入 flag，注意转义单引号
escaped_flag=$(printf "%s" "$custom_flag" | sed "s/'/\\'/g")
mysql -h"$mysql_host" -u"$mysql_user" -p"$mysql_pass" -D"$mysql_db" -e \
"INSERT INTO $mysql_table (flag) VALUES ('$escaped_flag');"

# 清理
export FLAG=not_here
rm -f /flag.sh
