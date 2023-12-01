FROM ubuntu:20.04

LABEL Organization="wjlin0" Author="wjlin0 wjlgeren@163.com"

MAINTAINER wjlin0@wjlin0.com <wjgeren@163.com>

COPY _files tmp/
COPY src /var/www/html


# 安装 Nginx, PHP 和 PostgreSQL 客户端的依赖
RUN apt-get update \
    && apt-get install -y wget gnupg2 software-properties-common \
    && mkdir -p /etc/apt/sources.list.d/ \
    && sh -c 'echo "deb http://apt.postgresql.org/pub/repos/apt/ focal-pgdg main" > /etc/apt/sources.list.d/pgdg.list' \
    && wget --quiet -O - https://www.postgresql.org/media/keys/ACCC4CF8.asc | apt-key add - \
    && add-apt-repository ppa:ondrej/php \
    && apt-get update \
    && apt-get install -y nginx php7.3 php7.3-fpm php7.3-pgsql postgresql-client \
    && apt-get install -y postgresql-12  \
    && echo "local   all             postgres                                trust\n# TYPE  DATABASE        USER            ADDRESS                 METHOD\n# \"local\" is for Unix domain socket connections only\nlocal   all             all                                     trust\n# IPv4 local connections:\nhost    all             all             127.0.0.1/32            trust\n# IPv6 local connections:\nhost    all             all             ::1/128                 trust\n# Allow replication connections from localhost, by a user with the\n# replication privilege.\nlocal   replication     all                                     trust\nhost    replication     all             127.0.0.1/32            trust\nhost    replication     all             ::1/128                 trust" > /etc/postgresql/$(ls /etc/postgresql)/main/pg_hba.conf \
    && service postgresql start \
    && psql -U postgres -f /var/www/html/db.sql \
    && service postgresql stop \
    && mv /tmp/flag.sh /flag.sh \
    && mv /tmp/docker-php-entrypoint /usr/local/bin/docker-php-entrypoint \
    && chmod +x /usr/local/bin/docker-php-entrypoint \
    && mv /tmp/nginx.conf /etc/nginx/nginx.conf \
    && chown -R www-data:www-data /var/www/html \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && rm -rf /var/www/html/db.sql \
    && rm -rf /tmp/* \
    && rm -rf /var/www/html/index.nginx-debian.html

WORKDIR /var/www/html

EXPOSE 80

VOLUME ["/var/log/nginx"]

CMD ["/bin/bash", "-c", "docker-php-entrypoint"]
