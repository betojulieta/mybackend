FROM php:8.2-fpm

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    nano \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql zip exif pcntl

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copia los archivos del proyecto
COPY . /var/www

WORKDIR /var/www

# Instala dependencias de Laravel
RUN composer install --no-interaction --optimize-autoloader

# Da permisos a las carpetas necesarias
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Puerto expuesto
EXPOSE 8000

# Comando de inicio
CMD php artisan serve --host=0.0.0.0 --port=8000
