FROM php:8.1-apache

# Install mysqli and other required extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy project files
COPY . /var/www/html/

# Create images directory and set permissions
RUN mkdir -p /var/www/html/admin/images && chown -R www-data:www-data /var/www/html/admin/images

# Set permissions for web root
RUN chown -R www-data:www-data /var/www/html/

# Expose port 80
EXPOSE 80

CMD ["apache2-foreground"]