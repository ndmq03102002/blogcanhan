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
        'App\Repositories\Interfaces\UserRepositoryInterface' => 'App\Repositories\UserRepository',
        'App\Services\Interfaces\CatServiceInterface'=>
        'App\Services\CatService',
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
