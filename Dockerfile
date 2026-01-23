FROM php:8.3-apache
WORKDIR /var/www/html
COPY index.php ./
EXPOSE 80