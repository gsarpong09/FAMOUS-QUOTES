FROM php:8.2-apache

# Enable mod_rewrite
RUN a2enmod rewrite

# Install PostgreSQL PDO driver
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copy your app files
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Expose port
EXPOSE 80
