<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\UrlGenerator $url)
    {
        if (env('APP_ENV') !== 'local') { //so you can work on it locally
            $url->forceScheme('https');
        }
    }
}
