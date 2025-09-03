<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\InterFaces\DeviceInterface;
use App\Repositories\DeviceRepo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            DeviceInterface::class,
            DeviceRepo::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
