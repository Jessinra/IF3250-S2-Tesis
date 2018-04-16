cd /home/gitlab-runner/builds/40ab4302/0/IF3250-Kelas2-Kelompok7-S2_TESIS/S2_TESIS/

composer install
composer dump-autoload

npm install

php artisan migrate
php artisan key:generate
php artisan config:cache

npm run build