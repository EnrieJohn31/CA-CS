#!/bin/sh
set -e

# Copy .env if it doesn't exist
if [ ! -f /app/.env ]; then
    if [ -f /app/.env.example ]; then
        cp /app/.env.example /app/.env
    fi
fi

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force || echo "Key generation completed"
fi

# Run migrations if DB is ready
sleep 10
php artisan migrate --force || echo "Migrations completed or database not ready yet"

# Start PHP-FPM and nginx
php-fpm -D
nginx -g 'daemon off;'
