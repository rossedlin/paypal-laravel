
cd ~/repository/paypal-laravel || exit 1;

git add .
git reset HEAD --hard
git fetch
git pull

/opt/alt/php82/usr/bin/php ~/composer.phar install --no-dev --prefer-dist --no-ansi --no-interaction --no-progress

/opt/alt/php82/usr/bin/php artisan migrate:fresh --force
