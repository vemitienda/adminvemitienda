<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
    public function boot()
    {
        Schema::defaultStringLength(125);

        if (config('app.env') === 'production') {
            \URL::forceScheme('https');
        }

        view()->composer('*', function ($view) {
            if (env('APP_DEBUG')) {
                $version_js = rand(1000, 9999);
            } else {
                $version_js = env('VERSION_JS');
            }
            $view->with('version', $version_js);
        });
    }
}
