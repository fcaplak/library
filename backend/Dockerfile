FROM php:8.1.0-fpm

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    libzip-dev \
    zip \
    jpegoptim optipng pngquant gifsicle \
    unzip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install gd pdo_mysql zip exif pcntl
RUN docker-php-ext-configure gd --enable-gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

COPY composer.json composer.lock ./
COPY . .
COPY ./.env.example ./.env

RUN composer install

RUN php artisan cache:clear
RUN php artisan key:generate --ansi

EXPOSE 8000

ENTRYPOINT php artisan migrate:fresh --seed && php artisan serve --host 0.0.0.0