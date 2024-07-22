#!/bin/bash

# Copiar o arquivo .env.example para .env se o .env não existir
if [ ! -f /var/www/.env ]; then
  cp .env.example .env
  php artisan key:generate
fi

# Iniciar o PHP-FPM
php-fpm
