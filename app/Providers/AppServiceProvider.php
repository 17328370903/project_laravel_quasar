<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TorMorten\Eventy\Facades\Events;

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
        Events::addAction('test.hook', function ($value) {
            dump($value);
        }, 1, 1);
    }
}
