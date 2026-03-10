FROM php

ADD --chmod=u+x https://github.com/php/pie/releases/download/1.3.9/pie.phar /usr/local/bin/pie
COPY 99-xdebug.ini $PHP_INI_DIR/conf.d

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

RUN pie install xdebug/xdebug
