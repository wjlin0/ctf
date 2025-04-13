# 创建新的镜像
FROM php:5.6-fpm-alpine

LABEL Organization="wjlin0" Author="wjlin0 wjlgeren@163.com"
MAINTAINER wjlin0@wjlin0.com <wjgeren@163.com>

COPY _files /tmp/
COPY src /var/www/html
# 安装 MySQL 相关包
RUN sed -i 's/dl-cdn.alpinelinux.org/mirrors.ustc.edu.cn/g' /etc/apk/repositories \
    && apk add --no-cache nginx \
    && apk add --no-cache m4 autoconf make gcc g++ linux-headers \
    && mkdir -p /run/nginx \
    && docker-php-ext-install pdo_mysql mysqli \
    # configure file
    && mv /tmp/flag.sh /flag.sh \
    && mv /tmp/docker-php-entrypoint /usr/local/bin/docker-php-entrypoint \
    && chmod +x /usr/local/bin/docker-php-entrypoint \
    && mv /tmp/nginx.conf /etc/nginx/nginx.conf \
    && mv /tmp/docker-php-ext.ini /usr/local/etc/php/conf.d \
    && chown -R www-data:www-data /var/www/html \
    && apk del m4 autoconf make gcc g++ linux-headers \
    && rm -rf /tmp/* \
    && rm -rf /var/cache/apk/*


CMD ["/bin/bash", "-c", "docker-php-entrypoint"]
