# PHP 8.2 + Apache
FROM php:8.2-apache

# Extensions PHP utiles pour projet PHP/MySQL + images
RUN docker-php-ext-install mysqli pdo pdo_mysql
# Si tu utilises GD pour manipuler des images (optionnel) :
RUN apt-get update && apt-get install -y libjpeg-dev libpng-dev libfreetype6-dev \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install gd \
  && rm -rf /var/lib/apt/lists/*

# Apache: activer mod_rewrite au besoin
RUN a2enmod rewrite

# Définir le DocumentRoot sur le dossier de ton app
# (ton code est monté par le volume, mais on fixe la conf vhost)
ENV APACHE_DOCUMENT_ROOT=/var/www/html/Cinephoria_php

# Remplacer le DocumentRoot dans la conf par défaut
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf /etc/apache2/apache2.conf