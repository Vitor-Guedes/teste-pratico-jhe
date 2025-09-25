# Use a base PHP image
FROM php:8.3-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    unzip \
    curl \
    libonig-dev \
    libzip-dev \
    libgd-dev \
    libpq-dev \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY ./app .

RUN if [ -f composer.json ]; then \
        composer install; \
    fi

RUN chown -R www-data:www-data app/storage/ app/bootstrap/cache/ && \
    chown -R 777 storage bootstrap/cache/;

EXPOSE 9000

CMD ["php-fpm"]