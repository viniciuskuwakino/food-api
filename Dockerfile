FROM php:8.1-fpm

# set your user name, ex: user=bernardo
ARG user=infra
ARG uid=1000

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    unzip \
    git \
    curl \
    wget \
    libaio1 \
    libonig-dev \
    libpng-dev \
    zlib1g-dev \
    vim \
    xclip

RUN apt-get update

RUN apt-get update -qq && apt-get -y install -qq libpq-dev

# Clear cache
RUN apt-get autoremove --yes
RUN rm -rf /var/lib/{apt,dpkg,cache,log}
RUN apt-get clean && rm -rf /var/lib/apt/lists/*


RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd sockets
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user
