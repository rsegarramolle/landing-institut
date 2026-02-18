FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    libzip-dev \
    zip \
    icu-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mysqli \
    zip \
    intl \
    gd \
    mbstring \
    opcache

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN adduser -D -g 'www' www-user && chown -R www-user:www-user /var/www/html

USER www-user

EXPOSE 9000
CMD ["php-fpm"]
