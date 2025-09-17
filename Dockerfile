FROM php:8.2-apache

# habilitar mod_rewrite para esconder a rota
RUN a2enmod rewrite

# habilitar .htaccess no /var/www/html
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# dependencias
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git \
 && docker-php-ext-install pdo pdo_mysql

# composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# permissoes
RUN chown -R www-data:www-data /var/www/html
