FROM php:8.2-apache

# 1. Включаем модуль rewrite для работы .htaccess и роутинга
RUN a2enmod rewrite

# 2. Ставим нужные системные пакеты и PHP расширения
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install mysqli pdo pdo_mysql zip

# 3. Копируем composer из официального образа
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Устанавливаем рабочую директорию
WORKDIR /var/www/html

# 5. Копируем файлы проекта
COPY . .

# 6. Ставим зависимости через composer
RUN composer install --no-interaction --optimize-autoloader

# 7. Права доступа для Apache
RUN chown -R www-data:www-data /var/www/html

# 8. МЕНЯЕМ КОРЕНЬ САЙТА НА PUBLIC (самое важное)
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf