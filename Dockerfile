# Usa PHP 8.2 con FPM
FROM php:8.2-fpm

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
    supervisor \
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

# Configura Supervisor para ejecutar PHP-FPM y Laravel en el puerto correcto
COPY docker/supervisor.conf /etc/supervisor/supervisor.conf

# Puerto expuesto (Render usa 10000)
EXPOSE 10000

# Comando de inicio - ejecuta migraciones y luego inicia Supervisor
CMD bash -c "php artisan migrate --force && supervisord -c /etc/supervisor/supervisor.conf"