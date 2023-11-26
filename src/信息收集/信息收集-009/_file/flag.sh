#!/usr/bin/env sh
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

# 进入临时目录
cd "$temp_dir"

# 初始化一个Git仓库并提交文件
git init
git add .
git commit -m "Initial commit"

# 复制.git目录到指定目录
cp -r .git /var/www/html/

# 返回原始目录
cd -

# 删除临时目录
rm -rf "$temp_dir"
