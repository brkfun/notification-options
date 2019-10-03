<?php

namespace BRKFun\NotificationOptions;

use BRKFun\NotificationOptions\Controllers\NotificationController;
use Illuminate\Support\ServiceProvider;

class NotificationOptionsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__ . '/../config/config.php' => config_path('notification-options.php'),
                ], 'config');

        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'notification-options');

        $this->app->make(NotificationController::class);

        $this->publishes(
            [
                __DIR__ . '/../resources/views' => resource_path('views/vendor/notification-options'),
            ], 'views');

        // Register the main class to use with the facade
        $this->app->singleton('notification-options', function () {
            return new NotificationOptions;
        });
    }
}
