FROM wjlin1/base_image_nginx_mysql_php:5.6
ENV TZ=Asia/Shanghai
LABEL org.opencontainers.image.authors="wjlin0"
COPY src/ /tmp/src/
COPY _file/flag.sh /flag.sh
COPY _file/nginx.conf /etc/nginx/nginx.conf
RUN apk add --update libzip-dev curl-dev  \
    && docker-php-ext-install curl \
    && mkdir -p /var/www/html2/ \
    && mv /tmp/src/index.php /var/www/html/ \
    && mv /tmp/src/flag.php /var/www/html2/ \
    && mv /tmp/src/index2.php /var/www/html2/index.php \
    && chown -R www-data:www-data /var/www/html2/ \
    && chmod -R 755 /var/www/html2/ \
    && rm -rf /var/cache/apk/* \
    && rm -rf /tmp/*