<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(191);
        config(['database.connections.mysql.charset' => 'utf8mb4']);
        config(['database.connections.mysql.collation' => 'utf8mb4_unicode_ci']);
    }
}
