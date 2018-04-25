composer install
composer dump-autoload

cp .env.testing .env

npm install

php artisan migrate
php artisan key:generate
php artisan config:cache

npm run production

