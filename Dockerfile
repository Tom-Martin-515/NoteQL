# Use official PHP image with Apache
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev npm

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy project files
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies and build assets
RUN npm install && npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
