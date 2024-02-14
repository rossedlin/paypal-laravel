
rm composer.lock
rm package-lock.json
rm -Rf node_modules
rm -Rf vendor

composer install
npm install

git add .
