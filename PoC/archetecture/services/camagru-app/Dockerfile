FROM php:8.3-fpm AS default

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
    && curl -sS https://getcomposer.org/installer | php

FROM default AS debug

RUN apt update -y && apt upgrade && apt install -y mariadb-client iputils-ping net-tools
