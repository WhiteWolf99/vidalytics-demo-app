FROM php:8.0-cli

RUN  apt-get update && apt-get install -y libzip-dev && docker-php-ext-install zip

COPY . /usr/src/myapp
WORKDIR /usr/src/myapp



COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN set -eux; \
	composer install --no-scripts --no-progress --no-suggest; \
	composer clear-cache; \
    composer dump-autoload --classmap-authoritative --no-dev;

CMD [ "php", "./app.php", "demo" ]