FROM php:8.3-apache

WORKDIR /var/www/html

# Nettoyer le dossier Apache par défaut
RUN rm -rf /var/www/html/*

# Installer extensions PHP nécessaires à Laravel + PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_pgsql

# Activer mod_rewrite pour Laravel
RUN a2enmod rewrite

# Copier la configuration Apache
COPY ./apache.conf /etc/apache2/sites-available/000-default.conf
RUN a2ensite 000-default.conf

# Copier le projet
COPY . /var/www/html

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Installer dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Installer dépendances front + build Vite
RUN npm install
RUN npm run build

# Générer .env + clé Laravel
RUN cp .env.example .env
RUN php artisan key:generate

# Donner les permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

