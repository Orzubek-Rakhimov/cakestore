FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
  libsqlite3-dev \
  pkg-config \
  && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_sqlite

COPY . /var/www/html

WORKDIR /var/www/html

RUN sed -i 's|/var/www/html|/var/www/html/public|g' \
  /etc/apache2/sites-available/000-default.conf

EXPOSE 80