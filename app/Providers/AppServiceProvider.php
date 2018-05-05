<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\Contracts\RoleRepositoryInterface::class,
            \App\Repositories\RoleRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\PermissionRepositoryInterface::class,
            \App\Repositories\PermissionRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\UserRepositoryInterface::class,
            \App\Repositories\UserRepository::class
        );
    }
}
