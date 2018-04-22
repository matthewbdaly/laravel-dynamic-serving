<?php

namespace Matthewbdaly\LaravelDynamicServing\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelDynamicServingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Helpers.php';
    }
}
