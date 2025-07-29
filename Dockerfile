FROM php:8.2-fpm

# Install PHP dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl libpq-dev libzip-dev zip \
    libonig-dev libxml2-dev libpng-dev libjpeg-dev libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo pdo_pgsql zip gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first
COPY composer.json composer.lock ./

# Fix git ownership issues
RUN git config --global --add safe.directory /var/www/html

# Install dependencies
RUN composer install --no-scripts --no-autoloader --no-interaction --prefer-dist

# Copy app files
COPY . .

# Finish composer setup
RUN composer install

# Clear and cache Laravel configs
RUN php artisan config:clear \
 && php artisan route:clear \
 && php artisan view:clear \
 && php artisan config:cache || true \
 && php artisan route:cache || true \
 && php artisan view:cache || true

# Expose port 80
EXPOSE 80

# CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
