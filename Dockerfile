# Use PHP official image
FROM php:8.3-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate key (optional fallback)
RUN php artisan key:generate || true

# Expose port
EXPOSE 10000

# Start Laravel
CMD php artisan serve --host=0.0.0.0 --port=10000