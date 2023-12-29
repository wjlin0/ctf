FROM wjlin1/base_image_nginx_mysql_php:7.4
ENV TZ=Asia/Shanghai
LABEL org.opencontainers.image.authors="wjlin0"
COPY src/ /var/www/html/
COPY _file/ /tmp/

RUN apk add shadow linux-headers  build-base openssl-dev  \
    && chmod 775 /var/www/html  \
    && usermod -aG www-data root  \
    && mv /tmp/flag.sh /flag.sh \
    && mv /tmp/docker-php-entrypoint /usr/local/bin/ \
    && chmod +x /flag.sh && chmod +x /usr/local/bin/docker-php-entrypoint  && chmod +x /usr/local/bin/docker-php-entrypoint \
    && cd /tmp/ && tar -xzvf curl-7.68.0.tar.gz \
    && cd curl-7.68.0 && ./configure && make && make install \
    && docker-php-ext-install curl \
    && cd /tmp/ && tar -xzvf redis-6.0.3.tar.gz \
    && cd redis-6.0.3 && make && make install \
    && mkdir  -p /var/log/redis/ && mv /tmp/redis-6.0.3/redis.conf /etc/redis.conf \
    && rm -rf /tmp/* \
    && rm -rf /var/cache/apk/*