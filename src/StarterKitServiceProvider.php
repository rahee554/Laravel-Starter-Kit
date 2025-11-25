<?php

namespace ArtflowStudio\StarterKit;

use Illuminate\Support\ServiceProvider;
use ArtflowStudio\StarterKit\Helpers\StarterKitHelper;
use Illuminate\Support\Facades\Blade;

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

        // Register view aliases for default layouts
        $this->registerViewAliases();

        // Register Blade helpers
        $this->registerBladeHelpers();

        // Publish auth layouts (published by default on install)
        $this->publishes([
            __DIR__.'/../resources/views/layouts/starterkit/auth' => resource_path('views/layouts/starterkit/auth'),
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
                Console\PublishFortifyServiceProvider::class,
            ]);
        }
    }

    /**
     * Register view aliases for default layouts.
     * 
     * Allows views to extend the default auth layout using:
     * @extends('starterkit::auth.default')
     */
    protected function registerViewAliases(): void
    {
        // Get the default auth layout view
        $defaultAuthLayout = StarterKitHelper::getDefaultAuthLayoutView();
        
        // Register an alias for easier reference
        $this->app['view']->addNamespace('starterkit-auth-default', function () use ($defaultAuthLayout) {
            return $defaultAuthLayout;
        });
    }

    /**
     * Register Blade helper directives.
     */
    protected function registerBladeHelpers(): void
    {
        // Get default auth layout
        Blade::directive('starterKitDefaultAuthLayout', function () {
            return "<?php echo '" . StarterKitHelper::getDefaultAuthLayoutView() . "'; ?>";
        });

        // Get default admin layout
        Blade::directive('starterKitDefaultAdminLayout', function () {
            return "<?php echo '" . StarterKitHelper::getDefaultAdminLayoutView() . "'; ?>";
        });

        // Get all auth layouts
        Blade::directive('starterKitAuthLayouts', function () {
            $layouts = StarterKitHelper::getAvailableAuthLayouts();
            return "<?php echo json_encode(" . var_export($layouts, true) . "); ?>";
        });

        // Get all admin layouts
        Blade::directive('starterKitAdminLayouts', function () {
            $layouts = StarterKitHelper::getAvailableAdminLayouts();
            return "<?php echo json_encode(" . var_export($layouts, true) . "); ?>";
        });
    }
}
