#!/bin/sh
set -e
cd /var/www/html

# Finalize the app at runtime (env vars are available now, not at build time).
php artisan package:discover --ansi 2>/dev/null || true
php artisan storage:link 2>/dev/null || true

# Start php-fpm (background) and nginx (foreground).
php-fpm -D
exec nginx -g 'daemon off;'
