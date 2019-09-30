<?php

namespace BRKFun\NotificationOptions;

use Illuminate\Support\ServiceProvider;

class NotificationOptionsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('notification-options.php'),
            ], 'config');

        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'notification-options');

        // Register the main class to use with the facade
        $this->app->singleton('notification-options', function () {
            return new NotificationOptions;
        });
    }
}
