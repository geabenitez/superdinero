FROM php:7.3-apache
WORKDIR /var/www/html
COPY ./app ./
COPY ./cert ./cert
COPY ./cert/default-ssl.conf /etc/apache2/sites-available
RUN a2ensite default-ssl.conf
RUN docker-php-ext-install mysqli
RUN chmod -R 777 assets/images
RUN a2enmod rewrite
RUN apache2ctl restart