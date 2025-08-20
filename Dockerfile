FROM php:8.2-apache

RUN a2enmod rewrite

COPY ./Cinephoria_php /var/www/html

WORKDIR /var/www/html

EXPOSE 80