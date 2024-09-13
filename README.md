cp .env.example .env  <br/>
npm i<br/>
composer install<br/>
php artisan key:generate<br/>
php artisan migrate:fresh --seed<br/>
php artisan serve<br/>

Para ejecutar PHPStan: vendor/bin/phpstan analyse app --level=7