FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u 1000 -d /home/katia katia
RUN mkdir -p /home/katia/.composer && \
    chown -R katia:katia /home/$user

RUN mkdir -p /var/www/storage/logs
RUN mkdir -p /var/www/storage/framework/views/
RUN chmod 777 -R /var/www/storage/framework/views/
RUN chmod 777 -R /var/www/storage/logs/   


COPY . /var/www/
WORKDIR /var/www
RUN composer install -o

# Set working directory
WORKDIR /var/www

USER $user
