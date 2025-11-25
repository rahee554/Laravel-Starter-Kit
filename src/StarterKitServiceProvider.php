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

        // Publish custom auth middleware
        $this->publishes([
            __DIR__.'/Http/Middleware/CustomAuthMiddleware.php' => app_path('Http/Middleware/CustomAuthMiddleware.php'),
        ], 'starterkit-middleware');

        // Publish custom auth listener
        $this->publishes([
            __DIR__.'/Listeners/AuthenticationListener.php' => app_path('Listeners/AuthenticationListener.php'),
        ], 'starterkit-listeners');

        // Publish custom auth service
        $this->publishes([
            __DIR__.'/Services/AuthService.php' => app_path('Services/AuthService.php'),
        ], 'starterkit-services');

        // Optional: Publish documentation
        $this->publishes([
            __DIR__.'/../docs' => base_path('docs/starterkit'),
        ], 'starterkit-docs');

        // Optional: Publish database migrations
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'starterkit-migrations');

        // Optional: Publish admin layouts
        $this->publishes([
            __DIR__.'/../resources/views/layouts/starterkit/admin' => resource_path('views/vendor/starterkit/layouts/admin'),
        ], 'starterkit-admin-layouts');

        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\InstallCommand::class,
            ]);
        }
    }
}
