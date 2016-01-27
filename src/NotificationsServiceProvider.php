<?php

namespace Panic\Notifications;

use Illuminate\Support\ServiceProvider;

class NotificationsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // $this->handleConfigs();
        // $this->handleMigrations();
        $this->handleViews();
        // $this->handleTranslations();
        $this->handleRoutes();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        return $this->app->bind('notifications', function ($app){
            return new Notifications;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return [];
    }
    private function handleConfigs() {
        $configPath = __DIR__ . '/../config/notifications.php';
        $this->publishes([$configPath => config_path('notifications.php')]);
        $this->mergeConfigFrom($configPath, 'notifications');
    }
    private function handleTranslations() {
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'notifications');
    }
    private function handleViews() {
        $this->loadViewsFrom(__DIR__.'/../views', 'notifications');
        $this->publishes([__DIR__.'/../views' => base_path('resources/views/panic/notifications')]);
    }
    private function handleMigrations() {
        $this->publishes([__DIR__ . '/../migrations' => base_path('database/migrations')]);
    }
    private function handleRoutes() {
        include __DIR__.'/Http/routes.php';
    }
}