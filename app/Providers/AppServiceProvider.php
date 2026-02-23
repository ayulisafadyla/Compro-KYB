<?php

namespace App\Providers;

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
        \Illuminate\Pagination\Paginator::useBootstrapFive();

        if (\Illuminate\Support\Facades\Schema::hasTable('site_settings')) {
            $site_settings = \App\Models\SiteSetting::all()->pluck('value', 'key');
            \Illuminate\Support\Facades\View::share('site_settings', $site_settings);
        }
    }
}
