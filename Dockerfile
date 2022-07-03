FROM php:7.4.29-zts

COPY . /usr/src/app
WORKDIR /usr/src/app
EXPOSE 8000


RUN docker-php-ext-install mysqli pdo pdo_mysql sockets bcmath \
        ctype \
        fileinfo \
        json 


RUN curl -sS https://getcomposer.org/installer | php -- \
     --install-dir=/usr/local/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer



RUN composer install --no-dev --no-interaction


CMD [ "php", "-t", "/usr/src/app/public", "-S", "0.0.0.0:8000" ]