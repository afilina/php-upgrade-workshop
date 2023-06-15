FROM php:5.3.29-apache

RUN rm -fr /tmp/xdebug \
    && git clone -b XDEBUG_2_2_0 https://github.com/xdebug/xdebug.git /tmp/xdebug \
    && cd /tmp/xdebug \
    && ./rebuild.sh

ADD .docker/php5/php.ini /usr/local/lib/php.ini

RUN service apache2 start
