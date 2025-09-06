<?php

namespace App\Providers;

use App\Models\JobOrderTool;
use App\Observers\JobOrderToolObserver;
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
        JobOrderTool::observe(JobOrderToolObserver::class);
    }
}
