
# PayPal Laravel

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

curl https://raw.githubusercontent.com/rossedlin/paypal-laravel/master/docker-compose.yml -o docker-compose.yml
curl https://raw.githubusercontent.com/rossedlin/paypal-laravel/master/up.sh -o up.sh
curl https://raw.githubusercontent.com/rossedlin/paypal-laravel/master/down.sh -o down.sh
curl https://raw.githubusercontent.com/rossedlin/paypal-laravel/master/bash.sh -o bash.sh

chmod +x ./*.sh

#
# Artisan
#
docker compose run --rm web bash -c "php artisan make:controller PayPalController"

#
# NPM (pre)
#
docker compose run --rm web bash -c "npm install vue vue-loader@next @vitejs/plugin-vue"

#
# GitHub Overrides
#
curl https://raw.githubusercontent.com/rossedlin/paypal-laravel/master/vite.config.js -o ./vite.config.js
curl https://raw.githubusercontent.com/rossedlin/paypal-laravel/master/routes/web.php -o ./routes/web.php
curl https://raw.githubusercontent.com/rossedlin/paypal-laravel/master/app/Http/Controllers/PayPalController.php -o ./app/Http/Controllers/PayPalController.php
curl https://raw.githubusercontent.com/rossedlin/paypal-laravel/master/resources/js/app.js -o ./resources/js/app.js
curl https://raw.githubusercontent.com/rossedlin/paypal-laravel/master/resources/js/App.vue -o ./resources/js/App.vue
curl https://raw.githubusercontent.com/rossedlin/paypal-laravel/master/resources/views/app.blade.php -o ./resources/views/app.blade.php

#
# Env
#
curl https://raw.githubusercontent.com/rossedlin/paypal-laravel/master/.env.example -o ./.env.example
docker compose run --rm web bash -c "rm .env; cp .env.example .env; php artisan key:generate"

#
# NPM (post)
#
docker compose run --rm web bash -c "npm run build"

#
# Git (post)
#
git add .

#
# Docker (Run)
#
docker compose up -d
