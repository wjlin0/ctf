FROM wjlin1/base_image_nginx_mysql_php:5.6
ENV TZ=Asia/Shanghai
LABEL org.opencontainers.image.authors="R4ph4e1-0x01"
COPY src/ /var/www/html/
COPY _file/flag.sh /flag.sh
RUN chown -R www-data:www-data /var/www/html
