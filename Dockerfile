FROM php:8.2-zts-alpine3.17

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer clear-cache \
    && composer -V

RUN apk add bash

WORKDIR /app
