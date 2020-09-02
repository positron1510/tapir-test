FROM php:7.4-fpm

WORKDIR /var/www/tapir-test

RUN apt-get update
RUN apt-get install curl
RUN apt install libonig-dev -y
RUN apt-get install libpq-dev -y
RUN docker-php-ext-install pdo pdo_mysql mbstring bcmath

EXPOSE 9000
CMD ["php-fpm"]
