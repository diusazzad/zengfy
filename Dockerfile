# Use the official PHP image based on Alpine Linux (PHP 8.4 matching composer platform)
FROM php:8.4-fpm-alpine

# Install PDO, MySQL extensions, and Node.js/NPM for frontend asset building
RUN docker-php-ext-install pdo pdo_mysql && \
    apk add --no-cache nodejs npm

# Configure high-performance OPcache for containerized Laravel
RUN printf "zend_extension=opcache\nopcache.enable=1\nopcache.enable_cli=1\nopcache.memory_consumption=256\nopcache.interned_strings_buffer=16\nopcache.max_accelerated_files=30000\nopcache.validate_timestamps=1\nopcache.revalidate_freq=60\nopcache.jit=1255\nopcache.jit_buffer_size=64M\n" > /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini

# Set the working directory inside the container to /var/www/html
# This is like telling the Chef: "Your kitchen is located here"
WORKDIR /var/www/html

# The default command to run when the container starts
# We use the ${APP_PORT} environment variable which we defined in docker-compose.yml (8001, 8002, 8003)
# --host=0.0.0.0 tells Laravel to accept connections from outside the container (like from Nginx)
CMD php artisan serve --host=0.0.0.0 --port=${APP_PORT}
