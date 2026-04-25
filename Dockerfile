# Stage 1: Build dependencies
FROM php:8.2-fpm as dependencies
WORKDIR /app

RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

COPY composer.json ./

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer install --no-dev --no-interaction --no-scripts --ignore-platform-reqs

# Stage 2: Node dependencies for assets
FROM node:18-alpine as node-builder
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci --legacy-peer-deps
COPY vite.config.js ./
COPY resources ./resources
COPY public ./public
RUN npm run build

# Stage 3: Production image
FROM php:8.2-fpm
WORKDIR /app

# Install system dependencies only
RUN apt-get update && apt-get install -y --no-install-recommends \
    nginx \
    mariadb-client \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Install essential PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Copy application code
COPY --chown=www-data:www-data . .

# Copy vendor from builder if it exists
COPY --from=dependencies --chown=www-data:www-data /app/vendor ./vendor

# Copy built Vite assets (public/build/manifest.json + hashed files)
COPY --from=node-builder --chown=www-data:www-data /app/public/build ./public/build

# Create required directories and set permissions
RUN mkdir -p storage/logs storage/framework/cache storage/framework/sessions bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap

# Configure nginx
COPY docker/nginx.conf /etc/nginx/sites-available/default
COPY docker/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]
