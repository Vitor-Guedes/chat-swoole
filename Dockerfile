FROM php:8.2-cli

RUN apt-get update && apt-get install vim -y && \
    apt-get install openssl -y && \
    apt-get install libssl-dev -y && \
    apt-get install wget -y && \
    apt-get install procps -y && \
    apt-get install htop -y

# Install Swoole
RUN pecl install swoole && docker-php-ext-enable swoole

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Composer and install
COPY --from=composer:2.1.9 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY ./app .

CMD ["php", "/var/www/html/server.php"]