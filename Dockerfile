# Utiliser l'image PHP 8.2 FPM comme base
FROM php:8.2-fpm

# Mettre à jour les paquets, installer les dépendances et nettoyer le cache
RUN apt-get update -y && apt-get install -y \
   build-essential \
   libpng-dev \
   libjpeg62-turbo-dev \
   libfreetype6-dev \
   locales \
   zip \
   libzip-dev \
   libexif-dev \
   libonig-dev \
   vim \
   unzip \
   git \
   curl \
   && docker-php-ext-install pdo_mysql zip exif pcntl \
   && docker-php-ext-configure gd --with-freetype --with-jpeg \
   && docker-php-ext-install gd \
   && apt-get clean \
   && rm -rf /var/lib/apt/lists/*

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier l'application dans le conteneur
COPY . /var/www

# Définir le répertoire de travail
WORKDIR /var/www

# Installer les dépendances du projet
RUN composer install --optimize-autoloader --no-dev

# Exposer le port pour l'application
EXPOSE 9002