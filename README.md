cp .env.example .env
npm i
composer install
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
