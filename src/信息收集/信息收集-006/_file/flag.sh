#!/usr/bin/env bash
sleep 1


# 检查环境变量是否已经设置
if [ -z "$FLAG" ]; then
    # 如果环境变量不存在，则设置默认值
    FLAG="flag{********************************}"
fi


# 创建一个临时目录
temp_dir=$(mktemp -d)

# 在临时目录中创建一个文件，写入FLAG的值
echo "$FLAG" > "$temp_dir/flag.txt"

# 将文件压缩到指定目录
tar -czf /var/www/html/www.tar.gz -C "$temp_dir" .

# 删除临时目录
rm -rf "$temp_dir"

export FLAG=not_here
rm -f /flag.sh
