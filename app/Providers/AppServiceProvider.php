<?php

namespace App\Providers;

use App\Services\MailgunService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register the MailgunService as a singleton
        $this->app->singleton(MailgunService::class, function ($app) {
            return new MailgunService();
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
