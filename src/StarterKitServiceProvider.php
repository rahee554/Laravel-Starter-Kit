<?php

namespace ArtflowStudio\StarterKit;

use ArtflowStudio\StarterKit\Providers\StarterKitFortifyServiceProvider;
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

        // Register Fortify service provider
        $this->app->register(StarterKitFortifyServiceProvider::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Load views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'starterkit');

        // Publish auth layouts (published by default on install)
        $this->publishes([
            __DIR__.'/../resources/views/layouts/starterkit/auth' => resource_path('views/vendor/starterkit/layouts/auth'),
        ], 'starterkit-auth-layouts');

        // Publish pre-built assets (published by default on install)
        $this->publishes([
            __DIR__.'/../public/vendor/artflow-studio/starterkit' => public_path('vendor/artflow-studio/starterkit'),
        ], 'starterkit-assets');

        // Publish configuration (published by default on install)
        $this->publishes([
            __DIR__.'/../config/starterkit.php' => config_path('starterkit.php'),
        ], 'starterkit-config');

        // Optional: Publish Fortify config (can be requested by user)
        if ($this->app->make('files')->exists(config_path('fortify.php'))) {
            $this->publishes([
                __DIR__.'/../config/fortify.php' => config_path('fortify.php'),
            ], 'starterkit-fortify-config');
        }

        // Optional: Publish documentation
        $this->publishes([
            __DIR__.'/../docs' => base_path('docs/starterkit'),
        ], 'starterkit-docs');

        // Optional: Publish database migrations
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'starterkit-migrations');

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
