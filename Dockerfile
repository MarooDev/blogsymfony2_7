FROM php:5.6-apache

# Remove stretch-updates and redirect repositories to archive
RUN sed -i '/stretch-updates/d' /etc/apt/sources.list \
    && sed -i 's/deb.debian.org/archive.debian.org/g' /etc/apt/sources.list \
    && sed -i 's/security.debian.org/archive.debian.org/g' /etc/apt/sources.list

# Install required packages and PHP extensions (allow unauthenticated)
RUN apt-get update \
    && apt-get install -y --allow-unauthenticated \
        libpng-dev \
        libjpeg-dev \
        libxml2-dev \
        zip \
        unzip \
        git \
    && docker-php-ext-install pdo pdo_mysql mbstring gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set DocumentRoot to /var/www/html/web for Symfony 2.7
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/web|g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80