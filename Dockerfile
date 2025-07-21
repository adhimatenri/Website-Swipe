FROM php:8.2-fpm

# Install PHP dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl libpq-dev libzip-dev zip \
    libonig-dev libxml2-dev && \
    docker-php-ext-install pdo pdo_pgsql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy app files
COPY . .

# Expose port 80
EXPOSE 80

CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]