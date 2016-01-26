<?php

namespace Panic\Notifications;

use Illuminate\Support\ServiceProvider;

class NotificationsServiceProvider extends ServiceProvider
{
    public function register()
    {
        return $this->app->bind('notifications', function ($app){
            return new Notifications;
        });
    }

    public function boot()
    {
        // loading the route file
        require __DIR__ . "/Http/routes.php";

        // define the path for the view files
        $this->loadViewsFrom(__DIR__ . '/../views/', 'notifications');

        // define the files which are going to be published
        /*$this->publishes([
            __DIR__ . '/migrations/2016_01_26_000000_create_log_notifications_table.php' => base_path('database/migrations/2016_01_26_000000_create_log_notifications_table.php')
        ]);*/
    }
}