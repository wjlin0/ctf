FROM python:3.9-slim

# 设置工作目录
WORKDIR /app

# 设置时区
ENV TZ=Asia/Shanghai
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# 安装系统依赖和MySQL
RUN apt-get update && apt-get install -y \
    default-mysql-server \
    tesseract-ocr \
    libmariadb-dev \
    pkg-config \
    && rm -rf /var/lib/apt/lists/* 

# 复制应用代码
COPY src/ /app/


# 启动 MySQL 服务，执行初始化 SQL，并关闭 MySQL
RUN sh -c 'mysqld_safe &' \
    && sleep 1 \
    && mysql -u root -e "source /app/db.sql" \
    && mysqladmin -u root -proot shutdown

# 安装Python依赖
RUN pip install --no-cache-dir -r requirements.txt

# 复制启动脚本
COPY _file/start.sh /start.sh
COPY _file/flag.sh /flag.sh
RUN chmod +x /start.sh

# 暴露端口
EXPOSE 8000

# 启动应用
ENTRYPOINT ["/start.sh"]