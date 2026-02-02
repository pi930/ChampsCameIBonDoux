FROM php:8.3-apache

# Dossier de travail
WORKDIR /var/www/html

# Nettoyer le dossier Apache par défaut
RUN rm -rf /var/www/html/*

# Installer les extensions PHP nécessaires à Laravel + PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql

# Activer mod_rewrite pour Laravel
RUN a2enmod rewrite

# Copier la configuration Apache
COPY ./apache.conf /etc/apache2/sites-available/000-default.conf

# Activer la configuration Apache (ligne manquante qui causait le "Not Found")
RUN a2ensite 000-default.conf

# Copier le projet Laravel
COPY . /var/www/html

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Installer les dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Générer le .env
RUN cp .env.example .env
RUN php artisan key:generate

# Donner les permissions nécessaires
RUN chown -R www-data:www-data /var/www/html

# Exposer le port Apache

