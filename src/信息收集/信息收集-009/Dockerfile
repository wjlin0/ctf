FROM ctftraining/base_image_nginx_mysql_php_56
ENV TZ=Asia/Shanghai
LABEL org.opencontainers.image.authors="wjlin0"
COPY src/ /var/www/html/
COPY _file/flag.sh /flag.sh
RUN apk add git