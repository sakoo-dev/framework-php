FROM php:8.1.2-fpm
LABEL MAINTAINER="Pouya Asgharnejad Tehran | https://sakoo.dev"

RUN apt-get update
RUN apt-get upgrade -y

RUN pecl install inotify
RUN docker-php-ext-enable inotify

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

RUN echo "xdebug.mode=develop,coverage,debug,gcstats,profile,trace" >> /usr/local/etc/php/conf.d/xdebug.ini
RUN echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini
RUN echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/xdebug.ini
RUN echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli

RUN apt-get install -y git curl zip unzip nodejs npm
RUN apt-get clean

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

WORKDIR /var/www/html/

HEALTHCHECK CMD php --version