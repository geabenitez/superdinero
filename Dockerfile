FROM php:7.3-apache
WORKDIR /var/www/html
COPY ./app ./
COPY ./cert ./cert
RUN docker-php-ext-install mysqli
RUN chmod -R 777 assets/images
RUN a2enmod rewrite
RUN apache2ctl restart