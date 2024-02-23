
# PayPal Laravel
docker compose down
docker container prune -f

if [ -e ~/Projects/paypal-laravel-scratch ]; then
    cd ~/Projects/paypal-laravel-scratch || exit;

    docker compose down
    docker container prune -f
fi

cd ~/Projects || exit;
rm -Rf ~/Projects/paypal-laravel-scratch

## Install

composer create-project laravel/laravel paypal-laravel-scratch
cd ~/Projects/paypal-laravel-scratch || exit;

## Git (pre)

git init
git add .
git commit -m "Init"

## Docker (Setup)

curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/paypal-laravel/master/docker-compose.yml -o docker-compose.yml
curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/paypal-laravel/master/up.sh -o up.sh
curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/paypal-laravel/master/down.sh -o down.sh
curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/paypal-laravel/master/bash.sh -o bash.sh

chmod +x ./*.sh

#
# Artisan
#
docker compose run --rm web bash -c "php artisan make:controller PayPalController"

#
# GitHub Overrides
#
curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/paypal-laravel/master/config/paypal.php -o ./config/paypal.php
curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/paypal-laravel/master/routes/web.php -o ./routes/web.php
curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/paypal-laravel/master/app/Http/Controllers/PayPalController.php -o ./app/Http/Controllers/PayPalController.php
curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/paypal-laravel/master/resources/views/checkout.blade.php -o ./resources/views/checkout.blade.php

#
# Env
#
curl -H 'Cache-Control: no-cache, no-store' https://raw.githubusercontent.com/rossedlin/paypal-laravel/master/.env.example -o ./.env.example
docker compose run --rm web bash -c "rm .env; cp .env.example .env; php artisan key:generate"

#
# Git (post)
#
git add .

#
# Docker (Run)
#
docker compose up -d
