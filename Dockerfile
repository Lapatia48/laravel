FROM php:8.2-fpm

# Install system packages + intl + mbstring + gd dependencies
RUN apt-get update && apt-get install -y \
    zip unzip curl \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libicu-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Set working directory
WORKDIR /var/www/html

# Copy composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Install Laravel dependencies
RUN composer install

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html

# Configure PHP-FPM to listen on all interfaces
RUN sed -i 's/listen = .*/listen = 0.0.0.0:9000/' /usr/local/etc/php-fpm.d/www.conf

EXPOSE 9000

CMD ["php-fpm"]
