FROM php:8.2-fpm

RUN apt-get update && apt-get upgrade -y \
    && apt-get install -y \
       zlib1g-dev \
       g++ \
       git \
       libicu-dev \
       zip \
       libzip-dev \
       php8.2-pgsql \
    && docker-php-ext-install intl opcache pdo mysqli pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

WORKDIR /var/www/symfony-app

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony
