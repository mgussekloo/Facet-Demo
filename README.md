## Demo Project for Laravel Facet Filter

This is the demo project for [Laravel Facet Filter](https://github.com/mgussekloo/laravel-facet-filter).
Instructions to get started:

- Clone the project
- Run: composer install
- Set up the database credentials in .env
- Publish migrations from the Laravel Facet Filter library: php artisan vendor:publish --tag="facet-filter-migrations"
- Run migrations, seed demo data: php artisan migrate:fresh --seed
- Build the Facet index: php artisan app:build-index
- Start a webserver: php artisan serve
