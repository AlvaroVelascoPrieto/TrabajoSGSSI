FROM php:8.0-apache
RUN a2enmod rewrite
RUN a2enmod headers
COPY ./security.conf /etc/apache2/conf-enabled/security.conf
COPY ./apache2.conf /etc/apache2/apache2.conf
RUN docker-php-ext-install mysqli




