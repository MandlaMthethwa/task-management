# Start from a base image
FROM php:8.2-apache

# Set the working directory
WORKDIR /var/www/html

# Copy your Laravel application files to the container
COPY . /var/www/html

# Install PHP extensions and other dependencies
RUN apt-get update \
    && apt-get install -y zip unzip \
    && docker-php-ext-install pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs

# Install Composer dependencies
RUN composer install

# Install Node.js dependencies
RUN npm install

# Build the frontend assets
RUN npm run dev

# Copy the Apache virtual host configuration file
COPY apache-site.conf /etc/apache2/sites-available/000-default.conf

# Enable Apache modules
RUN a2enmod rewrite

# Run database migration
RUN php artisan migrate --force

# Set permissions for storage and bootstrap cache folders
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose the Apache port
EXPOSE 80

# Start Apache service
CMD ["apache2-foreground"]
