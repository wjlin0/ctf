FROM php:5.6-apache

# 配置 Apache
RUN a2enmod rewrite

# 设置工作目录
WORKDIR /var/www/html

# 复制网站文件到临时目录
COPY _file/ /tmp/
ADD src/html.tar.gz /var/www/html
COPY src/www.zip /var/www/html/

# 移动 flag.sh 到根目录
RUN docker-php-ext-install mysql pdo pdo_mysql \
    && mv /tmp/flag.sh /flag.sh \
    && mv /tmp/docker-php-entrypoint /usr/local/bin/docker-php-entrypoint \
    && chmod +x /flag.sh /usr/local/bin/docker-php-entrypoint 


# 设置权限
RUN chown -R www-data:www-data /var/www/html

# 设置启动命令
ENTRYPOINT ["docker-php-entrypoint"] 