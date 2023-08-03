FROM php:8.1.20-apache

RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

ADD .docker/php8/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN docker-php-ext-install mysqli &&  \
    docker-php-ext-enable mysqli

RUN service apache2 start
