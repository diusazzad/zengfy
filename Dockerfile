# Use the official PHP image based on Alpine Linux (very lightweight)
FROM php:8.2-fpm-alpine

# Install PDO and MySQL extensions so Laravel can talk to the database
RUN docker-php-ext-install pdo pdo_mysql

# Set the working directory inside the container to /var/www/html
# This is like telling the Chef: "Your kitchen is located here"
WORKDIR /var/www/html

# The default command to run when the container starts
# We use the ${APP_PORT} environment variable which we defined in docker-compose.yml (8001, 8002, 8003)
# --host=0.0.0.0 tells Laravel to accept connections from outside the container (like from Nginx)
CMD php artisan serve --host=0.0.0.0 --port=${APP_PORT}
