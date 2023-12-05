# Use an official PHP image with Apache
FROM php:8.1-apache

# Copy Apache configuration
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Enable Apache modules
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Install required dependencies
RUN apt-get update && \
    apt-get install -y \
        git \
        unzip \
        libzip-dev

# Install PHP extensions
RUN docker-php-ext-install zip pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the project files into the container
COPY . /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Expose port 80
EXPOSE 80

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Start Apache server
CMD ["apache2-foreground"]

