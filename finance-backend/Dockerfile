# Use PHP 8.1 with Apache
FROM php:8.1-apache

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy application files
COPY . /var/www/html/

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html/
RUN chmod -R 755 /var/www/html/

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
