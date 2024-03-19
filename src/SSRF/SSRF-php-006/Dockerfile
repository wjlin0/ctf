FROM wjlin1/base_image_nginx_mysql_php:7.4
ENV TZ=Asia/Shanghai
LABEL org.opencontainers.image.authors="wjlin0"
COPY src/ /var/www/html/
COPY _file/flag.sh /flag.sh
COPY _file/my.cnf /etc/my.cnf
COPY _file/docker-php-entrypoint /usr/local/bin/
COPY _file/curl-7.68.0.tar.gz /tmp/

RUN apk add build-base openssl-dev \
    && cd /tmp/ \
    && tar -xzvf curl-7.68.0.tar.gz \
    && cd curl-7.68.0 && ./configure && make && make install
RUN docker-php-ext-install curl  \
    && sh -c 'mysqld_safe &' \
    && sleep 5s \
    && mysql -u root -proot -e "SET PASSWORD FOR 'root'@'localhost' = '';FLUSH PRIVILEGES;"  \
    && rm -rf /var/cache/apk/* \
    && chmod +x /usr/local/bin/docker-php-entrypoint
