# base
FROM php:8.3-fpm AS base
RUN apt-get update -y && apt-get upgrade -y \
    && echo 'msmtp msmtp/apparmor boolean true' | debconf-set-selections \
    && apt-get install -y \
        msmtp \
        msmtp-mta \
        curl \
        unzip \
		libfreetype-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd mysqli \
    && rm -rf /var/lib/apt/lists/* \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# production
FROM base AS production
# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY ./html /var/www/html

# development
FROM base AS development
# Use the default development configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
RUN apt update -y && apt upgrade && apt install -y mariadb-client iputils-ping net-tools
