# ---------------------------------------------------------
# Base image: PHP 8.2 with Apache
# ---------------------------------------------------------
FROM php:8.2-apache

# ---------------------------------------------------------
# Install system dependencies
# ---------------------------------------------------------
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    openssl npm && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite (Laravel needs this)
RUN a2enmod rewrite

# ---------------------------------------------------------
# Install Composer
# ---------------------------------------------------------
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# ---------------------------------------------------------
# Copy project files
# ---------------------------------------------------------
COPY . /var/www/html
WORKDIR /var/www/html

# ---------------------------------------------------------
# Install PHP dependencies
# ---------------------------------------------------------
RUN composer install --no-dev --optimize-autoloader

# ---------------------------------------------------------
# Install Node dependencies + build Vite assets
# ---------------------------------------------------------
RUN npm install && npm run build

# ---------------------------------------------------------
# Set Apache DocumentRoot to /public
# ---------------------------------------------------------
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf && \
    sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/apache2.conf

# ---------------------------------------------------------
# Set correct permissions
# ---------------------------------------------------------
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# ---------------------------------------------------------
# Expose port 80 (Apache default)
# ---------------------------------------------------------
EXPOSE 80

# ---------------------------------------------------------
# Start Apache
# ---------------------------------------------------------
CMD ["apache2-foreground"]
