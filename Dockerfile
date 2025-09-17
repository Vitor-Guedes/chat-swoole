# Use a base image with PHP CLI
FROM php:8.2-cli-alpine

# Install system dependencies required for Swoole and other extensions
RUN apk add --no-cache \
    git \
    make \
    autoconf \
    g++ \
    openssl-dev \
    php82-dev \
    php82-pear \
    brotli-dev

# Install the Swoole extension via PECL
RUN pecl install openswoole \
    && docker-php-ext-enable openswoole

# Copy your application code into the container
WORKDIR /app

COPY ./app .

# Install Composer dependencies (if your project uses Composer)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

# Expose the port your Swoole server will listen on
EXPOSE 9501

# Define the command to run your Swoole application
# CMD ["php", "server.php"]
CMD ["tail", "-f", "/dev/null"]