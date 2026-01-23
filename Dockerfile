# ---- Build stage ----
FROM composer:2.7 AS vendor
COPY composer.* ./
RUN composer install --no-dev --optimize-autoloader

# ---- Runtime stage ----
FROM php:8.3-apache
WORKDIR /var/www/html

# Install common extensions (adjust to taste)
RUN apt-get update \
 && apt-get install -y libpng-dev libonig-dev libxml2-dev zip unzip \
 && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Copy app
COPY --from=vendor /app/vendor ./vendor
COPY src/ ./

# Let Render assign the port
ENV PORT=80
EXPOSE 80
