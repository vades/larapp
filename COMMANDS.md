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
