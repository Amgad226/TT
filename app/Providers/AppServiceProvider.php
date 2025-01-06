<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\TelescopeApplicationServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (class_exists(TelescopeApplicationServiceProvider::class)) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // dd(Auth::user());

    }
}
