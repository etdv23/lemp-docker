FROM php:8.5.2-fpm

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
        libpq-dev \
        libicu-dev \
        zip \
        libxslt-dev \
        gnupg \
        gnupg1 \
        gnupg2 \
        vim

RUN docker-php-ext-install mysqli \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install zip \
    && docker-php-ext-install xsl \
    && docker-php-ext-install intl \
    && docker-php-ext-install exif \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql \
    && docker-php-ext-install pdo_pgsql
    
RUN pecl install redis xdebug \
    && docker-php-ext-enable redis xdebug

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
COPY zz_user.ini /usr/local/etc/php/conf.d/zz_user.ini

RUN curl -o /tmp/composer-setup.php https://getcomposer.org/installer
RUN php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm -rf /tmp/composer-setup.php
