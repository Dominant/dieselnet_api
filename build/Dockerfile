# Set the base image to Ubuntu
FROM phusion/baseimage:0.9.22

CMD ["/sbin/my_init"]

RUN apt-get update && apt-get install -y python-software-properties && add-apt-repository -y ppa:ondrej/php
RUN apt-get update && apt-get install -y php7.2 php7.2-fpm php7.2-cli php7.2-common php7.2-mbstring php7.2-gd php7.2-intl php7.2-xml php7.2-mysql php7.2-curl php7.2-zip php7.2-bcmath git unzip

COPY ./build/php.ini /etc/php/7.2/fpm/php.ini
COPY ./build/php-fpm.conf /etc/php/7.2/fpm/php-fpm.conf
COPY ./build/www.conf /etc/php/7.2/fpm/pool.d/www.conf

RUN touch /var/log/php_errors.log && chown www-data:www-data /var/log/php_errors.log
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/api
COPY ./ /var/www/api

RUN composer install

RUN mkdir -p /run/php && chmod 0755 /run/php && chown www-data:www-data /run/php
RUN mkdir /etc/service/phpfpm ; echo "#!/bin/sh\nexec /usr/sbin/php-fpm7.2 --nodaemonize --fpm-config /etc/php/7.2/fpm/php-fpm.conf" > /etc/service/phpfpm/run; chmod +x /etc/service/phpfpm/run;

RUN apt-get update && apt-get install -y nginx apache2-utils
RUN usermod -u 1000 www-data

EXPOSE 9090

RUN rm -v /etc/nginx/nginx.conf
ADD ./build/nginx.conf /etc/nginx/

RUN mkdir /etc/service/nginx ; echo "#!/bin/sh\nexec /usr/sbin/nginx -g 'daemon off;'" > /etc/service/nginx/run; chmod +x /etc/service/nginx/run;
