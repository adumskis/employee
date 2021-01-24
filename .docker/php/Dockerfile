#################################################################################
#                                  BASE IMAGES                                  #
#################################################################################
###
# base
###
FROM php:7.4-fpm-buster AS base
RUN apt-get update && apt-get install -y libzip-dev zlib1g-dev libicu-dev g++
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN docker-php-ext-install zip pcntl pdo pdo_mysql
RUN pecl install redis
RUN docker-php-ext-enable redis
COPY .docker/php/php.ini /usr/local/etc/php/conf.d/php.ini
WORKDIR /code

###
# base-with-composer
###
FROM base AS base-with-composer
RUN apt-get update && apt-get install -y git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

###
# base-with-composer-node-and-xdebug
###
FROM base-with-composer AS base-with-composer-and-xdebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
COPY .docker/php/xdebug-configuration.ini /usr/local/etc/php/conf.d/xdebug-configuration.ini

#################################################################################
#                                   ENV IMAGES                                  #
#################################################################################
###
# dev
###
FROM base-with-composer-and-xdebug AS dev
ARG USER_ID
ARG GROUP_ID
USER $USER_ID:$GROUP_ID
