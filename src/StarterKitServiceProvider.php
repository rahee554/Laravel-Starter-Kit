<?php

namespace ArtflowStudio\StarterKit;

use Illuminate\Support\ServiceProvider;

class StarterKitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Merge package configuration
        $this->mergeConfigFrom(
            __DIR__.'/../config/starterkit.php', 'starterkit'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Publish views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/starterkit'),
        ], 'starterkit-views');

        // Publish pre-built assets to public/vendor/artflow-studio/starterkit
        $this->publishes([
            __DIR__.'/../public/vendor/artflow-studio/starterkit' => public_path('vendor/artflow-studio/starterkit'),
        ], 'starterkit-assets');

        // Publish configuration
        $this->publishes([
            __DIR__.'/../config/starterkit.php' => config_path('starterkit.php'),
        ], 'starterkit-config');

        // Publish migrations
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'starterkit-migrations');

        // Optional: Publish documentation (explicitly requested)
        $this->publishes([
            __DIR__.'/../docs' => base_path('docs/starterkit'),
        ], 'starterkit-docs');

        // Optional: Publish Fortify customizations (explicitly requested)
        $this->publishes([
            __DIR__.'/../app/Listeners' => app_path('Listeners'),
            __DIR__.'/../app/Http/Middleware' => app_path('Http/Middleware'),
            __DIR__.'/../app/Http/Controllers' => app_path('Http/Controllers'),
        ], 'starterkit-fortify-customizations');

        // Load views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'starterkit');

        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\InstallCommand::class,
                Console\PublishCommand::class,
                Console\BuildPackageCommand::class,
            ]);
        }
    }
}
