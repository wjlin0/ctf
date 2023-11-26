FROM wjlin1/base_image_nginx_mysql_php:5.6
ENV TZ=Asia/Shanghai
LABEL org.opencontainers.image.authors="wjlin0"
RUN apk add shadow && \
    chmod 775 /var/www/html && \
    usermod -aG www-data mysql && \
    usermod -aG mysql www-data
COPY src/ /var/www/html/
COPY _file/flag.sh /flag.sh
COPY _file/my.cnf /etc/mysql/my.cnf