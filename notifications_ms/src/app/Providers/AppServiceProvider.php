<?php

namespace App\Providers;

use Domain\Service;
use Domain\Interfaces\NotificationServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        require base_path('domain/_bootstrap.php');

        $this->app->bind(NotificationServiceInterface::class, Service::class);
    }
}
