<?php

// app/Providers/AppServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Dotenv\Dotenv;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadEnvironmentFromDomain();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Load environment variables based on the domain.
     *
     * @return void
     */
    protected function loadEnvironmentFromDomain(): void
    {
        $domain = request()->getHost();
        switch ($domain) {
            case '127.0.0.1':
                $envFile = '.env.ivnbg';
                break;
            case 'client2.example.com':
                $envFile = '.env.client2';
                break;
            case 'client3.example.com':
                $envFile = '.env.client3';
                break;
            default:
                $envFile = '.env';
                break;
        }

        if (file_exists(base_path().'/'.$envFile)) {

            $dotenv = Dotenv::createImmutable(base_path(), $envFile);
            $dotenv->load();

        }

    }
}

