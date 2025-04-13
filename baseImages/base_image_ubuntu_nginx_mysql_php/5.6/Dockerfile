FROM ubuntu:latest

LABEL Organization="wjlin0" Author="wjlin0 wjlgeren@163.com"

MAINTAINER wjlin0@wjlin0.com <wjgeren@163.com>

COPY _files /tmp/
COPY src /var/www/html
# 设置非交互式安装
ENV TZ=Asia/Shanghai
ENV DEBIAN_FRONTEND=noninteractive

RUN sed -i "s/archive.ubuntu.com/mirrors.aliyun.com/g" /etc/apt/sources.list \
    && apt update && DEBIAN_FRONTEND=noninteractive  apt install -y software-properties-common && add-apt-repository ppa:ondrej/php \
    && DEBIAN_FRONTEND=noninteractive apt install -y mysql-server nginx  mysql-client \
    && DEBIAN_FRONTEND=noninteractive apt install -y php5.6-fpm && DEBIAN_FRONTEND=noninteractive apt install -y php5.6-mysql php5.6-mysqli \
    # init mysql \
    && chown -R mysql:mysql /var/lib/mysql \
    && mysqld --initialize --user=mysql --datadir=/var/lib/mysql \
    && sh -c 'mysqld_safe &' \
    && sleep 5s \
    && mysqladmin -uroot password 'root' \
    && mysql -e "source /var/www/html/db.sql;" -uroot -proot \
    # configure file
    && mv /tmp/flag.sh /flag.sh \
    && mv /tmp/docker-php-entrypoint /usr/local/bin/docker-php-entrypoint \
    && chmod +x /usr/local/bin/docker-php-entrypoint \
    && mv /tmp/nginx.conf /etc/nginx/nginx.conf \
    && chown -R www-data:www-data /var/www/html \
#    && mv /tmp/docker-php-ext-mysqli.ini /usr/local/etc/php/conf.d \
#    && mv /tmp/docker-php-ext-pdo_mysql.ini /usr/local/etc/php/conf.d \
    # clear \
    && rm -rf /var/www/html/db.sql \
    && rm -rf /tmp/*

WORKDIR /var/www/html

EXPOSE 80

ENTRYPOINT ["/bin/bash", "-c", "docker-php-entrypoint"]
