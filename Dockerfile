FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libicu-dev \
    mariadb-client \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . /var/www/html

# Ensure correct permissions
RUN chown -R www-data:www-data /var/www/html

# Install Composer dependencies without scripts or autoloader initially
RUN composer install --no-scripts --no-autoloader

# Run Composer tasks and Laravel setup commands
RUN mkdir -p storage/framework/{sessions,views,cache} storage/app/public storage/logs \
    && composer dump-autoload --optimize

# Expose port 80
EXPOSE 80

# Final command to start the server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]