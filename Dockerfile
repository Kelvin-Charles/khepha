# Use the official PHP image with Apache
FROM php:8.1-apache

# Install the mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy the application files into the container
COPY . /var/www/html/

# Expose port 80 (internal to the container)
EXPOSE 80
