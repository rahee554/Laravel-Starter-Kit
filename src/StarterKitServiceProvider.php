<?php

namespace ArtflowStudio\StarterKit;

use ArtflowStudio\StarterKit\Helpers\StarterKitHelper;
use ArtflowStudio\StarterKit\Providers\StarterKitFortifyServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Log;
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
        // Load views from the package directory
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'starterkit');

        // Register Blade helpers
        $this->registerBladeHelpers();

        // Register the Fortify Service Provider that configures StarterKit views
        // Only register if Fortify is installed (config exists)
        if (file_exists(config_path('fortify.php'))) {
            $this->app->register(StarterKitFortifyServiceProvider::class);
        } else {
            Log::info('StarterKit: Fortify config not found. Fortify views and rate limiting will not be registered. Run fortify:install first.');
        }

        // Publish pre-built assets (published by default on install)
        $this->publishes([
            __DIR__.'/../public/vendor/artflow-studio/starterkit' => public_path('vendor/artflow-studio/starterkit'),
        ], 'starterkit-assets');

        // Publish configuration (published by default on install)
        $this->publishes([
            __DIR__.'/../config/starterkit.php' => config_path('starterkit.php'),
        ], 'starterkit-config');

        // Optional: Publish documentation
        $this->publishes([
            __DIR__.'/../docs' => base_path('docs/starterkit'),
        ], 'starterkit-docs');

        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\InstallCommand::class,
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
