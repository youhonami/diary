FROM php:8.2-fpm-bookworm

RUN apt-get update && apt-get install -y \
unzip \
git \
curl \
libzip-dev \
libonig-dev \
libpng-dev \
libxml2-dev \
zlib1g-dev \
default-mysql-client \
&& docker-php-ext-install pdo_mysql zip mbstring

COPY php.ini /usr/local/etc/php/

RUN curl -sS https://getcomposer.org/installer | php \
&& mv composer.phar /usr/local/bin/composer \
&& composer self-update

WORKDIR /var/www