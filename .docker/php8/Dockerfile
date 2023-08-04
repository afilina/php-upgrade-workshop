FROM php:8.1.20-apache

RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

ADD .docker/php8/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN docker-php-ext-install mysqli && \
    docker-php-ext-enable mysqli

RUN apt-get update
RUN apt-get install -y libzip-dev zip && \
    docker-php-ext-install zip && \
    docker-php-ext-enable zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD .docker/php8/vhost.conf /etc/apache2/sites-enabled/000-default.conf

RUN a2enmod rewrite
RUN service apache2 start
