FROM php:8.1.20-apache

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

ADD .docker/php8/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN service apache2 start
