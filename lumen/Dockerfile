FROM php:7.3.3-fpm-alpine3.9

RUN sed -i s,http://dl-cdn.alpinelinux.org,http://mirrors.aliyun.com,g  /etc/apk/repositories \
    && apk update \
    && apk add --update --no-cache autoconf g++ imagemagick-dev \
        libtool make pcre-dev imap-dev \
        zlib-dev bash git nginx supervisor \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && apk del autoconf g++ libtool make pcre-dev \
    && mkdir /etc/supervisor.d/

RUN apk add libzip-dev

RUN docker-php-ext-install pdo pdo_mysql mysqli imap mbstring zip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php --no-ansi --install-dir=/usr/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

RUN echo "alias phpunit=\"./vendor/bin/phpunit\"" >> ~/.bashrc

WORKDIR /var/www

ENTRYPOINT ["supervisord", "--nodaemon", "--configuration", "/etc/supervisord.conf"]

ADD . /var/www

RUN touch /var/www/storage/logs.log \
    && chmod 666 /var/www/storage/logs.log \
    && touch /var/www/storage/logs/elk.log \
    && chmod 666 /var/www/storage/logs/elk.log


COPY ./docker/supervisor.ini /etc/supervisor.d/supervisor.ini
COPY ./docker/dev.php.ini /usr/local/etc/php/conf.d/php.ini
COPY ./docker/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf

RUN chown -R www-data.www-data /var/www/storage \
    && chown -R www-data.www-data /var/www/bootstrap 
    # && echo "* * * * * php /var/www/artisan schedule:run >> /home/www-data/crond.log 2>&1" >> /var/spool/cron/crontabs/root

RUN cd /var/www && composer install -vvv --no-dev