#!/bin/bash

apt-get update

apt-get install -y \
    jq \
    unzip \
    less \
    entr \
    openssh-client \
    mariadb-client
