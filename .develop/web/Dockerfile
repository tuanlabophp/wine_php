FROM php:7.1.4-apache

MAINTAINER Nguyen Hoang Tien <tiennguyenhoang339@gmail.com>

# Install modules
RUN apt-get update && apt-get install -y \
    g++ \
    zip \
    vim \
    curl \
    supervisor \
    mailutils \
    alien \
    telnet \
    libaio1 \
    php-pear \
    php-apc \
    libldap2-dev \
    libpq-dev \
    libmemcached-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng12-dev \
    libmcrypt-dev \
    libicu-dev \
    libsqlite3-dev \
    libssl-dev \
    libcurl3-dev \
    libxml2-dev \
    libzzip-dev \
    libpcre3-dev \
    --no-install-recommends apt-utils \
    && rm -r /var/lib/apt/lists/*

# Configure GD library
RUN docker-php-ext-configure gd \
    --enable-gd-native-ttf \
    --with-jpeg-dir=/usr/lib \
    --with-freetype-dir=/usr/include/freetype2

# Install extensions using the helper script provided by the base image
RUN docker-php-ext-install \
        gd \
        bcmath \
        pdo_mysql \
        pdo_pgsql \
        mcrypt \
        zip \
        mysqli

WORKDIR /var/www/app

COPY ./web/entrypoint.sh /scripts/entrypoint.sh

RUN chmod a+x /scripts/entrypoint.sh

ENTRYPOINT ["/scripts/entrypoint.sh"]

CMD ["apache2-foreground"]

EXPOSE 80
