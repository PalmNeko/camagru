FROM php:8.3-fpm AS default

RUN docker-php-ext-install mysqli
RUN apt-get update -y && apt-get upgrade -y \
    && echo 'msmtp msmtp/apparmor boolean true' | debconf-set-selections \
    && apt-get install -y \
        msmtp \
        msmtp-mta \
    && rm -rf /var/lib/apt/lists/*

FROM default AS debug

RUN apt update -y && apt upgrade && apt install -y mariadb-client iputils-ping net-tools
