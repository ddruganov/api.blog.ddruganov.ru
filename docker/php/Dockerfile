FROM php:8.1-fpm-alpine

RUN apk add postgresql-dev zsh

RUN docker-php-ext-install pdo pdo_pgsql

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

WORKDIR /app
