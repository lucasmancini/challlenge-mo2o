ARG PHP_VERSION
FROM php:${PHP_VERSION}-fpm

#ARG UID
#RUN adduser -u $UID --disabled-password --gecos "" appuser
#RUN mkdir /home/appuser/.ssh
#RUN chown -R appuser:appuser /home/appuser/
#RUN echo "StrictHostKeyChecking no" >> /home/appuser/.ssh/config

RUN apt-get update -y && \
    apt-get install libpng-dev -y && \
    apt-get install libldap2-dev -y && \
    apt-get install libicu-dev -y && \
    apt-get install zip -y &&\
    apt-get install libzip-dev -y &&\
    apt-get install zip -y \
#    build-essential \
#    libjpeg62-turbo-dev \
#    libfreetype6-dev \
#    locales \
#    jpegoptim optipng pngquant gifsicle \
#    vim \
#    unzip \
#    git \
#    curl \

#EXTENSIONS
RUN docker-php-ext-install gd
RUN docker-php-ext-install zip
RUN docker-php-ext-install intl
#RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
#RUN docker-php-ext-install opcache
#RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-configure intl
RUN docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ && \
docker-php-ext-install ldap

#COMPOSER
RUN curl --insecure https://getcomposer.org/download/2.2.9/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

#XDEBUG
ARG XDEBUG_ENV
RUN if [ ${XDEBUG_ENV} = "development" ]; then \
    pecl install xdebug && docker-php-ext-enable xdebug; \
fi;

#SYMFONY CLI
#RUN echo "export COLUMNS=300" >> /home/appuser/.bashrc
#RUN echo "alias sf='/usr/local/bin/php /var/www/bin/console'" >> /home/appuser/.bashrc
RUN curl -sS https://get.symfony.com/cli/installer | bash && mv /root/.symfony/bin/symfony /usr/local/bin/symfony

#INSTALL SYMFONY
RUN mkdir -p /var/www
#RUN chown -R appuser:appuser /var/www
WORKDIR /var/www
#USER appuser
