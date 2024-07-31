<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    protected $serviceBindings = [
        'App\Services\Interfaces\UserServiceInterface'=>
        'App\Services\UserService',
        
        'App\Services\Interfaces\CatServiceInterface'=>
        'App\Services\CatService',
        'App\Services\Interfaces\PostServiceInterface'=>
        'App\Services\PostService',
    ];
    public function register(): void
    {
        foreach ($this->serviceBindings as $interface => $service) {
            $this->app->bind($interface, $service);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
