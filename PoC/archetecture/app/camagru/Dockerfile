FROM php:8.3-fpm AS default

# https://github.com/mlocati/docker-php-extension-installer
# を使ってphpの拡張機能をインストールした。
# なぜなら、軽くなる、https://hub.docker.com/_/php#php-core-extensions で紹介されていた。
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN install-php-extensions mysqli

FROM default AS debug

RUN apt update -y && apt upgrade && apt install -y mariadb-client iputils-ping net-tools
