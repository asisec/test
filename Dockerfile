# ============================================
# Textile Forum — Dockerfile
# PHP 8.1 + Apache + Composer
# ============================================

FROM php:8.1-apache

LABEL maintainer="TextileForum DevOps"

# -----------------------------------------------
# 1. Sistem Bağımlılıkları
# -----------------------------------------------
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    unzip \
    zip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libwebp-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    libexif-dev \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# -----------------------------------------------
# 2. PHP Eklentileri
# -----------------------------------------------
RUN docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mysqli \
        gd \
        intl \
        zip \
        bcmath \
        exif \
        pcntl \
        mbstring \
        xml \
        opcache

# -----------------------------------------------
# 3. Composer Kurulumu
# -----------------------------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# -----------------------------------------------
# 4. Apache Yapılandırması
# -----------------------------------------------
RUN a2enmod rewrite headers

COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# -----------------------------------------------
# 5. PHP Yapılandırması
# -----------------------------------------------
COPY docker/php.ini /usr/local/etc/php/conf.d/99-custom.ini

# -----------------------------------------------
# 6. Uygulama Dosyalarını Kopyala
# -----------------------------------------------
WORKDIR /var/www/html
COPY . /var/www/html/

# -----------------------------------------------
# 7. Composer Bağımlılıkları
#    Erişilemeyen paketleri kaldırıp stub oluşturur
# -----------------------------------------------
COPY docker/composer-setup.sh /tmp/composer-setup.sh
RUN chmod +x /tmp/composer-setup.sh && /tmp/composer-setup.sh

# -----------------------------------------------
# 8. Laravel Package Discovery
# -----------------------------------------------
WORKDIR /var/www/html/public_html/core
RUN php artisan package:discover --ansi 2>&1 || true

# -----------------------------------------------
# 9. Dosya İzinleri
# -----------------------------------------------
WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/public_html/core/storage \
    && chmod -R 775 /var/www/html/public_html/core/bootstrap/cache \
    && chmod -R 775 /var/www/html/public_html/assets/uploads \
    && chmod -R 775 /var/www/html/public_html/banner-resimleri

# -----------------------------------------------
# 10. Entrypoint Script
# -----------------------------------------------
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["entrypoint.sh"]
CMD ["apache2-foreground"]
