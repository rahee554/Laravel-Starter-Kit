<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Authentication Layout
    |--------------------------------------------------------------------------
    |
    | This option controls which authentication layout to use by default.
    |
    | Available layouts:
    | - centered: Classic centered box layout
    | - split: Split screen with branding
    | - minimal: Clean minimal design
    | - glass: Glassmorphism effect
    | - particles: Animated particles background (DEFAULT)
    | - hero: Large hero section
    | - modern: Contemporary design
    | - 3d: Three-dimensional effects
    | - premium-dark: Dark premium theme
    | - gradient-flow: Animated gradients
    | - clean: Minimalist approach
    | - hero-grid: Grid-based hero
    | - sidebar: Sidebar-based auth
    | - base: Base layout (minimal HTML structure)
    |
    | Usage in Fortify Views:
    | @extends(config('starterkit.auth_layout_view'))
    | OR
    | @php $helper = new \ArtflowStudio\StarterKit\Helpers\StarterKitHelper; @endphp
    | @extends($helper::getDefaultAuthLayoutView())
    |
    */

    'auth_layout' => env('STARTERKIT_AUTH_LAYOUT', 'particles'),

    /*
    | Computed view path for default auth layout (read-only)
    | Used internally by the package
    */
    'auth_layout_view' => fn() => \ArtflowStudio\StarterKit\Helpers\StarterKitHelper::getDefaultAuthLayoutView(),

    /*
    |--------------------------------------------------------------------------
    | Default Admin Layout
    |--------------------------------------------------------------------------
    |
    | This option controls which admin layout to use by default.
    |
    | Available layouts:
    | - sidebar: Classic sidebar navigation (DEFAULT)
    | - topnav: Horizontal top navigation
    | - minimal: Clean minimalist admin
    | - neo: Modern futuristic admin
    | - classic: Traditional admin panel
    |
    | Usage:
    | @extends(config('starterkit.admin_layout_view'))
    | OR
    | @php $helper = new \ArtflowStudio\StarterKit\Helpers\StarterKitHelper; @endphp
    | @extends($helper::getDefaultAdminLayoutView())
    |
    */

    'admin_layout' => env('STARTERKIT_ADMIN_LAYOUT', 'sidebar'),

    /*
    | Computed view path for default admin layout (read-only)
    | Used internally by the package
    */
    'admin_layout_view' => fn() => \ArtflowStudio\StarterKit\Helpers\StarterKitHelper::getDefaultAdminLayoutView(),

    /*
    |--------------------------------------------------------------------------
    | Dark Mode
    |--------------------------------------------------------------------------
    |
    | Enable or disable dark mode support. When enabled, users can toggle
    | between light and dark themes using the data-bs-theme attribute.
    |
    */

    'dark_mode' => [
        'enabled' => true,
        'default' => 'light', // 'light' or 'dark'
        'allow_user_preference' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Application Name Display
    |--------------------------------------------------------------------------
    |
    | Configure how the application name is displayed in layouts.
    |
    */

    'app_name' => [
        'show_in_auth' => true,
        'show_in_admin' => true,
        'logo_text' => env('APP_NAME', 'Laravel'),
        'logo_initial' => null, // Auto-generated from APP_NAME if null
    ],

    /*
    |--------------------------------------------------------------------------
    | Asset Paths
    |--------------------------------------------------------------------------
    |
    | Configure the paths to compiled CSS and JS assets.
    | Assets are pre-built and published to public/vendor/artflow-studio/starterkit
    |
    */

    'assets' => [
        'auth' => [
            'css' => 'vendor/artflow-studio/starterkit/assets/auth.css',
            'js' => 'vendor/artflow-studio/starterkit/assets/auth.js',
        ],
        'admin' => [
            'css' => 'vendor/artflow-studio/starterkit/assets/admin.css',
            'js' => 'vendor/artflow-studio/starterkit/assets/admin.js',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Features
    |--------------------------------------------------------------------------
    |
    | Configure which features are enabled in the starter kit.
    |
    */

    'features' => [
        'particles' => true,
        'form_validation' => true,
        'remember_me' => true,
        'password_toggle' => true,
        'social_auth' => false, // Future feature
    ],

];
