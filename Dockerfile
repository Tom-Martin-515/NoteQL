# ---------------------------------------------------------
# Base image: PHP 8.2 with Apache
# ---------------------------------------------------------
FROM php:8.2-apache

# ---------------------------------------------------------
# Install system dependencies + PHP extensions
# ---------------------------------------------------------
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    npm && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
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

# Set working directory
WORKDIR /var/www/html

# ---------------------------------------------------------
# Composer install (production)
# ---------------------------------------------------------
ENV COMPOSER_MEMORY_LIMIT=-1

RUN ls -la && ls -la /var/www/html && php -v && composer --version || true

RUN composer install --no-dev --optimize-autoloader -vvv

# ---------------------------------------------------------
# Build Vite assets
# ---------------------------------------------------------
RUN npm install && npm run build

# Verify Vite output exists
RUN ls -la public && ls -la public/build || echo "⚠️ Vite build folder missing"

# ---------------------------------------------------------
# Set Apache DocumentRoot to /public
# ---------------------------------------------------------
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf && \
    sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/apache2.conf

# ---------------------------------------------------------
# Permissions
# ---------------------------------------------------------
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# ---------------------------------------------------------
# Expose port 80
# ---------------------------------------------------------
EXPOSE 80

# ---------------------------------------------------------
# Start Apache
# ---------------------------------------------------------
CMD ["apache2-foreground"]
