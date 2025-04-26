# Usa PHP 8.2
FROM php:8.2

# Instala dependencias del sistema y extensiones de PHP
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
    && docker-php-ext-install pdo pdo_pgsql pgsql zip exif pcntl bcmath

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copia los archivos del proyecto
COPY . /var/www

WORKDIR /var/www

# Instala dependencias de Laravel
RUN composer install --no-interaction --optimize-autoloader

# Da permisos a las carpetas necesarias
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expone el puerto que Render espera
EXPOSE 10000

# Comando de inicio - ejecuta migraciones y luego inicia Laravel en el puerto 10000
CMD bash -c "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000"
