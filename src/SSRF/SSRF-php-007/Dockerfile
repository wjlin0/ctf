FROM wjlin1/base_image_nginx_mysql_php:7.4
ENV TZ=Asia/Shanghai
LABEL org.opencontainers.image.authors="wjlin0"
COPY src/ /var/www/html/
COPY _file/ /tmp/

RUN mv /tmp/flag.sh /flag.sh \
    && mv /tmp/docker-php-entrypoint /usr/local/bin/ \
    && chmod +x /flag.sh && chmod +x /usr/local/bin/docker-php-entrypoint  && chmod +x /usr/local/bin/docker-php-entrypoint \
    && apk add build-base openssl-dev \
    && cd /tmp/ \
    && tar -xzvf curl-7.68.0.tar.gz \
    && cd curl-7.68.0 && ./configure && make && make install \
    && docker-php-ext-install curl  \
    && apk add redis \
    && rm -rf /var/cache/apk/*