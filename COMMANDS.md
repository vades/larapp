# Laravel quick commands
- `php artisan serve` Running Laravel
- `npm run dev` Running Vite
- `php artisan make:controller ControllerName` Create a new controller
- `php artisan route:list` List all routes
- `php artisan make:component web.features.blog --view`
- `php artisan make:livewire dir.component-name` Create a new Livewire component
- `php artisan make:livewire dir.component-name --inline` Create a new inline Livewire component
- `php artisan livewire:stubs` Publish Livewire stubs
- `php artisan livewire:layout` Create a new layout file
- `php artisan make:seeder SeederName` Create a new middleware
- `php artisan migrate:reset`
- `php artisan migrate:refresh`
- `php artisan migrate:refresh --seed --force`
- `php artisan db:seed`
- `php artisan cache:clear`
- `php artisan view:clear`
- `php artisan config:clear`
- `php artisan route:clear`
- `composer dump-autoload`
- `php artisan tinker`
- `php artisan make:scope ProjectScope`
- `php artisan make:trait`
- `php artisan make:command CustomTask`
- `php artisan make:class CustomClass`

```
-c, --controller Create a new controller for the model
-f, --factory Create a new factory for the model
--force Create the class even if the model already exists
-m, --migration Create a new migration file for the model
-s, --seed Create a new seeder file for the model
-p, --pivot Indicates if the generated model should be a custom intermediate table model
-r, --resource Indicates if the generated controller should be a resource controller
For More Help
php artisan make:model Todo -help
```
 
```bash
php artisan cache:clear
php artisan view:clear
php artisan config:clear
php artisan route:clear
composer dump-autoload
```

```
 base_path();    // '/var/www/mysite'
  app_path();     // '/var/www/mysite/app'
  storage_path(); // '/var/www/mysite/storage'
```
