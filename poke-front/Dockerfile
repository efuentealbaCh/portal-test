# Dockerfile en poke-front
FROM php:8.2-fpm

WORKDIR /var/www/html

# Instalar dependencias necesarias para Composer y PHP
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    curl \
    git \
    && docker-php-ext-install zip

# Descargar e instalar Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Comprobar que Composer está instalado correctamente
RUN composer --version

# Copiar el resto del proyecto primero (incluyendo el archivo artisan)
COPY . .

# Instalar dependencias de Laravel
RUN composer install

CMD ["php-fpm"]
