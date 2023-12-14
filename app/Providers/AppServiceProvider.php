<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Utilities\CrudUtilities;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CrudUtilities::class, function () {
            return new CrudUtilities();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
