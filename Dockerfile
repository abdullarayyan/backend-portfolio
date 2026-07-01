# Production image for the Laravel 8 portfolio backend.
# Uses serversideup/php (nginx + php-fpm, Laravel-tuned, non-root) on PHP 8.3.
# Serves the app from /var/www/html/public on port 8080.
FROM serversideup/php:8.3-fpm-nginx

# Document root is /var/www/html; nginx serves the ./public folder automatically.
WORKDIR /var/www/html

# Copy the application source (vendor/ is built below, not copied).
COPY --chown=www-data:www-data . /var/www/html

# Install PHP dependencies for production.
RUN composer install \
        --no-dev \
        --optimize-autoloader \
        --no-interaction \
        --prefer-dist \
        --no-progress

# Ensure Laravel's writable paths are owned by the runtime user.
RUN chown -R www-data:www-data storage bootstrap/cache

# serversideup/php already exposes 8080 and defines the entrypoint/healthcheck.
