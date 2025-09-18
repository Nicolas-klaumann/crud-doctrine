FROM php:8.2-cli

# dependências
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git \
 && docker-php-ext-install pdo pdo_mysql

# composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# permissões
RUN chown -R www-data:www-data /var/www/html

# comando para rodar o servidor embutido do PHP apontando para public/
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
