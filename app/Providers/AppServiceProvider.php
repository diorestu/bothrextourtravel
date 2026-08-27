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
        if (!app()->runningInConsole() || app()->runningUnitTests()) {
            try {
                \Illuminate\Support\Facades\View::share('company', \App\Models\CompanySetting::getSettings());
            } catch (\Exception $e) {
                // fallback if DB not migrated yet
            }
        }
    }
}
