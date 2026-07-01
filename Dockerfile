# Production image for the Laravel 8 portfolio backend.
# nginx + php-fpm on PHP 8.3, serving ./public on port 3000 (Dokploy's routed port).
FROM php:8.3-fpm-bookworm

# System packages + PHP extensions required by the app.
RUN apt-get update && apt-get install -y --no-install-recommends \
        nginx \
        unzip \
        git \
        libonig-dev \
    && docker-php-ext-install -j"$(nproc)" pdo_mysql mbstring bcmath \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Composer (from the official composer image).
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy the application source (vendor/ is built below; see .dockerignore).
COPY . /var/www/html

# nginx site + startup script, install deps, fix writable-path ownership.
RUN cp docker/nginx-default.conf /etc/nginx/sites-available/default \
    && cp docker/entrypoint.sh /usr/local/bin/entrypoint.sh \
    && chmod +x /usr/local/bin/entrypoint.sh \
    && composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-progress --no-scripts \
    && chown -R www-data:www-data storage bootstrap/cache

EXPOSE 3000
CMD ["/usr/local/bin/entrypoint.sh"]
