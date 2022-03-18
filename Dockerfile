ARG COMPOSER_VERSION="latest"
FROM composer:${COMPOSER_VERSION} as composer

FROM php:7.4.28-fpm-alpine

COPY --from=composer /usr/bin/composer /usr/local/bin/composer
RUN composer --version

WORKDIR /usr/src/test-trainig
COPY . /usr/src/test-trainig