FROM php:8.1-fpm

WORKDIR /app

ARG USERNAME=tm
ARG USERID=1000
ARG USERGROUPNAME=tm
ARG USERGROUPID=1000

#ARG SSH_PRIVATE_KEY
#ARG SSH_PRIVATE_KEY_FILE=id_rsa

RUN groupadd -g $USERGROUPID -o $USERGROUPNAME &&\
    useradd -m -u $USERID -g $USERGROUPID -o -s /bin/bash $USERNAME &&\
    usermod -aG sudo $USERNAME
    #mkdir -p /home/$USERNAME/.ssh &&\
    #echo "${SSH_PRIVATE_KEY}" > /home/$USERNAME/.ssh/$SSH_PRIVATE_KEY_FILE &&\
    #chmod 400 /home/$USERNAME/.ssh/$SSH_PRIVATE_KEY_FILE &&\
    #ssh-keyscan -t rsa gitlab.com >> /home/$USERNAME/.ssh/known_hosts &&\
    #ssh-keyscan -t rsa gitlab.develit.se >> /home/$USERNAME/.ssh/known_hosts &&\
    #ssh-keyscan -t rsa github.com >> /home/$USERNAME/.ssh/known_hosts &&\
    #chown $USERNAME:$USERGORUPNAME -R /home/$USERNAME/.ssh

RUN apt-get update &&\
    apt-get install -y libzip-dev &&\
    apt-get install -y gnupg2 &&\
    apt-get install -y libpng-dev libfreetype6-dev libjpeg62-turbo-dev &&\
    apt-get install -y --no-install-recommends supervisor &&\
    apt-get install -y default-mysql-client &&\
    apt-get install -y ffmpeg

COPY ./supervisor/supervisord.conf /etc/supervisor
RUN chgrp -R $USERGROUPNAME /var/log &&\
    chmod -R g+w /var/log

#RUN apt-key adv --keyserver ha.pool.sks-keyservers.net --recv-keys 8C718D3B5072E1F5 &&\
#    echo "deb http://repo.mysql.com/apt/debian/ buster mysql-8.0" > /etc/apt/sources.list.d/mysql.list &&\
#    apt-get update &&\
#    apt-get install -y mysql-community-client

RUN docker-php-ext-install zip &&\
    docker-php-ext-install pdo_mysql &&\
    docker-php-ext-configure gd --with-freetype --with-jpeg &&\
    docker-php-ext-install -j$(nproc) gd &&\
    pecl install redis && docker-php-ext-enable redis

COPY ./php/conf.d/custom.ini /usr/local/etc/php/conf.d/custom.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
