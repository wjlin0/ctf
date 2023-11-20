#!/bin/bash

# 检查是否提供了足够的参数
if [ "$#" -ne 2 ]; then
    echo "Usage: $0 <path> <action>"
    exit 1
fi

# 获取脚本所在目录
script_directory=$(dirname "$0")

# 获取用户提供的相对路径或绝对路径
base_directory="$1"

# 如果用户提供的是相对路径，则组合为绝对路径
if [[ "$base_directory" != /* ]]; then
    base_directory="$script_directory/$base_directory"
fi

action="$2"  # 获取命令行参数中的操作类型

# 遍历目录
for directory in "$base_directory"/*; do
    if [ -d "$directory" ]; then
        echo "Entering directory: $directory"
        cd "$directory" || exit 1

        # 根据操作类型执行相应的命令
        case "$action" in
            "build")
                # 运行 docker-compose up -d 命令
                docker-compose up -d
                ;;
            "down")
                # 运行 docker-compose down 命令
                docker-compose down
                ;;
            "remove")
                # 运行 docker-compose down --rmi all 命令
                docker-compose down --rmi all
                ;;
            "push")
                # 运行 docker-compose push 命令
                docker-compose push
                ;;
            *)
                # 未知的操作类型
                echo "Unknown action: $action"
                ;;
        esac

        # 返回上级目录
        cd "$base_directory" || exit 1
    fi
done

echo "脚本执行完成"