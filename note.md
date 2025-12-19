# Dans le conteneur Laravel
docker exec -it laravel_app php artisan migrate:status
# Exécutez dans le conteneur
docker exec -it laravel_app php artisan make:migration create_categories_table
# execution de la migration
docker exec -it laravel_app php artisan migrate



# creation de model:
docker exec -it laravel_app php artisan make:model Category



# creation de seeder:
docker exec -it laravel_app php artisan make:seeder CategorySeeder
# execution de seeder:
docker exec -it laravel_app php artisan db:seed
# Ou pour tout réinitialiser
docker exec -it laravel_app php artisan migrate:fresh --seed




# creation de controller:
docker exec -it laravel_app php artisan make:controller CategoryController





# Exécuter les migrations
php artisan migrate

# Exécuter les seeders
php artisan db:seed

# Ou pour réinitialiser complètement
php artisan migrate:fresh --seed