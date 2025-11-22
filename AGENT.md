# 🤖 AI Agent Guidelines for AF Laravel Starter Kit

**Complete guide for AI agents and developers working with the AF Laravel Starter Kit package**

This document provides comprehensive guidelines for understanding, maintaining, and extending the AF Laravel Starter Kit. Use this as a reference when working with the package architecture, customizations, and integrations.

---

## 📋 Table of Contents

1. [Package Overview](#package-overview)
2. [Architecture & Structure](#architecture--structure)
3. [Installation & Publishing](#installation--publishing)
4. [Key Components](#key-components)
5. [Customization Points](#customization-points)
6. [Development Workflow](#development-workflow)
7. [Publishing Strategy](#publishing-strategy)
8. [Best Practices](#best-practices)
9. [Troubleshooting Guide](#troubleshooting-guide)
10. [Extension Patterns](#extension-patterns)

---

## Package Overview

### What This Package Does

AF Laravel Starter Kit is a production-ready Laravel package that provides:

- **18 pre-built layouts** (13 auth + 5 admin) with beautiful designs
- **Pre-compiled assets** (CSS/JS) - no build step required after installation
- **Bootstrap 5.3.8 integration** with custom enhancements
- **Dark mode support** using Bootstrap's native system
- **Optional Fortify customizations** for advanced authentication
- **Complete documentation** and interactive layout showcase

### Key Philosophy

- **Zero-build after install**: Pre-compiled assets mean users don't need npm
- **Optional customizations**: Fortify customizations only publish when requested
- **Self-contained**: Everything needed is included, nothing extra
- **Bootstrap-native**: Uses Bootstrap's systems, not custom frameworks

### Target Users

- Laravel developers needing quick authentication setup
- Agencies building multiple Laravel projects
- Teams wanting professional, consistent UI across projects
- Developers who prefer pre-built over building from scratch

---

## Architecture & Structure

### Directory Organization

```
package/
│
├── src/
│   ├── Console/
│   │   ├── InstallCommand.php           # Main installation entry point
│   │   ├── PublishCommand.php           # Custom publish command
│   │   └── BuildPackageCommand.php      # Build/package for distribution
│   │
│   └── StarterKitServiceProvider.php    # Service provider - main integration
│
├── config/
│   └── starterkit.php                   # Package configuration file
│
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── auth/                    # 13 authentication layout templates
│   │   │   │   ├── particles.blade.php
│   │   │   │   ├── centered.blade.php
│   │   │   │   ├── glass.blade.php
│   │   │   │   └── ... (10 more)
│   │   │   │
│   │   │   └── admin/                   # 5 admin layout templates
│   │   │       ├── sidebar.blade.php
│   │   │       ├── topnav.blade.php
│   │   │       └── ... (3 more)
│   │   │
│   │   └── components/                  # Reusable Blade components
│   │       ├── auth-assets.blade.php    # CSS/JS loader for auth
│   │       ├── admin-assets.blade.php   # CSS/JS loader for admin
│   │       └── ... (other components)
│   │
│   └── css/
│       ├── auth.scss                    # Authentication styles (compiled)
│       ├── admin.scss                   # Admin styles (compiled)
│       └── (modular SCSS organized by purpose)
│
├── public/vendor/artflow-studio/starterkit/
│   └── assets/                          # PRE-BUILT, PRODUCTION-READY ASSETS
│       ├── auth.css                     # 257 KB, ready to use
│       ├── auth.js                      # 4 KB, ready to use
│       ├── admin.css                    # 235 KB, ready to use
│       └── admin.js                     # 4 KB, ready to use
│
├── app/
│   ├── Listeners/
│   │   └── AuthenticationListener.php   # Event listeners (OPTIONAL - not published by default)
│   │
│   └── Http/
│       ├── Middleware/
│       │   └── CustomAuthMiddleware.php (OPTIONAL - not published by default)
│       │
│       └── Controllers/
│           └── CustomAuthRedirectController.php (OPTIONAL - not published by default)
│
├── routes/
│   └── test-layouts.php                 # Route for layout testing/preview
│
├── database/
│   └── migrations/                      # Database migrations
│
├── docs/
│   ├── START_HERE.md                    # Quick start guide
│   ├── LAYOUTS_DOCUMENTATION.html       # Interactive layout showcase
│   ├── DARK_MODE_GUIDE.md               # Dark mode implementation
│   ├── SCSS_COMPONENTS_GUIDE.md         # CSS classes reference
│   └── FINAL_PROJECT_COMPLETION.md      # Complete project overview
│
├── composer.json                        # Package metadata
├── README.md                            # Main documentation (this you're reading)
└── AGENT.md                             # This file - AI agent guidelines
```

### Architecture Diagram

```
┌─────────────────────────────────────────────────────────────┐
│                    AF Laravel Starter Kit                    │
│                      (composer package)                      │
└─────────────────────────────────────────────────────────────┘
                              │
                              ▼
                 ┌────────────────────────┐
                 │  ServiceProvider.php   │
                 │  (boots everything)    │
                 └────────────────────────┘
                              │
        ┌─────────────────────┼─────────────────────┐
        ▼                     ▼                     ▼
    ┌────────────┐      ┌─────────────┐      ┌──────────────┐
    │   Views    │      │  Assets     │      │ Commands     │
    │ (18 layout)│      │ (CSS/JS)    │      │ (Install,    │
    │ templates  │      │ (prebuilt)  │      │  Publish)    │
    │            │      │             │      │              │
    └────────────┘      └─────────────┘      └──────────────┘
        │                     │                     │
        └─────────────────────┼─────────────────────┘
                              ▼
                     ┌──────────────────────┐
                     │  Publishing System   │
                     │  (7 different tags)  │
                     └──────────────────────┘
                              │
        ┌─────────────────────┼─────────────────────┐
        ▼                     ▼                     ▼
    ┌─────────────┐   ┌──────────────────┐   ┌──────────────┐
    │ Normal      │   │ Configuration    │   │ Fortify      │
    │ Assets      │   │ & Customization  │   │ Optional     │
    │ (Published  │   │ Files            │   │ Customs      │
    │  by default)│   │ (Published opt.) │   │ (NOT by def.)│
    └─────────────┘   └──────────────────┘   └──────────────┘
```

---

## Installation & Publishing

### Installation Flow

```
composer require artflow-studio/starterkit
                        ▼
        Laravel loads ServiceProvider
                        ▼
        php artisan starterkit:install
                        ▼
        ┌─────────────────────────────────────┐
        │    InstallCommand.php executes:     │
        │  1. Publish views                   │
        │  2. Publish assets                  │
        │  3. Publish config                  │
        │  4. Publish routes                  │
        │  5. Install Fortify (if missing)    │
        │  6. Run migrations (optional)       │
        └─────────────────────────────────────┘
                        ▼
        Application ready to use!
```

### Publishing Tags System

The package uses Laravel's publishing system with multiple tags:

```
┌────────────────────────────────────────────────────────────┐
│          Publishing Tags (What & When to Publish)          │
└────────────────────────────────────────────────────────────┘

┌─ starterkit-views ─────────────────────────────┐
│ Published: By InstallCommand + on demand       │
│ Destination: resources/views/vendor/starterkit │
│ Contains: All 18 layouts + components          │
└────────────────────────────────────────────────┘

┌─ starterkit-assets ────────────────────────────┐
│ Published: By InstallCommand + on demand       │
│ Destination: public/vendor/artflow-studio      │
│ Contains: Pre-built CSS/JS files               │
└────────────────────────────────────────────────┘

┌─ starterkit-config ────────────────────────────┐
│ Published: By InstallCommand + on demand       │
│ Destination: config/starterkit.php             │
│ Contains: Configuration file                   │
└────────────────────────────────────────────────┘

┌─ starterkit-migrations ────────────────────────┐
│ Published: On demand only (optional)           │
│ Destination: database/migrations/              │
│ Contains: Database migration files             │
└────────────────────────────────────────────────┘

┌─ starterkit-docs ──────────────────────────────┐
│ Published: On demand only (optional)           │
│ Destination: docs/starterkit/                  │
│ Contains: All documentation files              │
└────────────────────────────────────────────────┘

┌─ starterkit-fortify-customizations ────────────┐
│ Published: EXPLICITLY REQUESTED ONLY           │
│ Destination: app/ (Middleware, Controllers)    │
│ Contains: CustomAuthMiddleware.php             │
│           CustomAuthRedirectController.php     │
│           AuthenticationListener.php           │
│                                                │
│ ⚠️  NOT PUBLISHED BY DEFAULT - INTENTIONAL    │
│ These are optional enhancements for apps      │
│ that need advanced custom auth logic          │
└────────────────────────────────────────────────┘
```

### Publishing Commands

```bash
# Standard installation (publishes views, assets, config by default)
php artisan starterkit:install

# Publish individual components
php artisan vendor:publish --tag=starterkit-views
php artisan vendor:publish --tag=starterkit-assets
php artisan vendor:publish --tag=starterkit-config

# Publish documentation (optional)
php artisan vendor:publish --tag=starterkit-docs

# Publish ONLY if you need custom auth logic (explicitly opt-in)
php artisan vendor:publish --tag=starterkit-fortify-customizations

# Force overwrite existing files
php artisan vendor:publish --force --tag=starterkit-views
```

---

## Key Components

### 1. ServiceProvider (StarterKitServiceProvider.php)

**Purpose**: Main integration point, registers all package services

**Responsibilities**:
- Register configuration
- Define publishing groups
- Load views
- Register Artisan commands
- Setup route loading

**Key Methods**:
- `register()` - Merge package configuration
- `boot()` - Publish assets, load views, register commands

**Important Details**:
- Views are loaded with namespace `starterkit`
- Assets publish to `public/vendor/artflow-studio/starterkit`
- Fortify customizations in separate tag (intentional)

### 2. InstallCommand (Console/InstallCommand.php)

**Purpose**: User-friendly installation with sensible defaults

**What It Does**:
1. Publishes views to `resources/views/vendor/starterkit`
2. Publishes assets to `public/vendor/artflow-studio/starterkit`
3. Publishes configuration to `config/starterkit.php`
4. Publishes test routes to `routes/test-layouts.php`
5. Installs Laravel Fortify if missing
6. Optionally runs migrations

**Key Options**:
- `--layout=NAME` - Set default layout
- `--force` - Force overwrite existing files

### 3. Views & Layouts

**Location**: `resources/views/`

**Structure**:
```
views/
├── layouts/
│   ├── auth/          # 13 authentication layouts
│   │   ├── particles.blade.php
│   │   ├── centered.blade.php
│   │   ├── glass.blade.php
│   │   └── ... (10 more unique designs)
│   │
│   └── admin/         # 5 admin layouts
│       ├── sidebar.blade.php
│       ├── topnav.blade.php
│       ├── minimal.blade.php
│       ├── neo.blade.php
│       └── classic.blade.php
│
└── components/
    ├── auth-assets.blade.php
    ├── admin-assets.blade.php
    └── ... (utility components)
```

**Layout Characteristics**:
- All extend Bootstrap 5.3.8
- Support dark mode via `data-bs-theme`
- Fully responsive (mobile-first)
- Use CSS custom properties for theming
- Can be customized by overriding in `resources/views/vendor/starterkit`

**Usage Example**:
```blade
@extends('starterkit::layouts.auth.particles')
@section('content')
    <!-- Your form here -->
@endsection
```

### 4. Pre-Built Assets

**Location**: `public/vendor/artflow-studio/starterkit/assets/`

**Files**:
- `auth.css` (257 KB) - All authentication layout styles, compiled and minified
- `auth.js` (4 KB) - Authentication functionality
- `admin.css` (235 KB) - All admin layout styles
- `admin.js` (4 KB) - Admin functionality

**Important**: Assets are PRE-BUILT and ready to use. No npm build required!

**Loading**: Components auto-load assets:
```blade
@include('starterkit::components.auth-assets')
```

### 5. Configuration File

**Location**: `config/starterkit.php` (after publishing)

**Key Settings**:
```php
return [
    'layouts' => [
        'auth' => env('STARTERKIT_AUTH_LAYOUT', 'particles'),
        'admin' => env('STARTERKIT_ADMIN_LAYOUT', 'sidebar'),
    ],

    'dark_mode' => [
        'enabled' => true,
        'default' => 'light',
    ],

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
];
```

### 6. Optional Fortify Customizations

**Important**: These are NOT published by default. Users must explicitly opt-in.

**Files** (in `app/` directory):

#### CustomAuthMiddleware
```php
// app/Http/Middleware/CustomAuthMiddleware.php
// Purpose: Add custom authentication checks before request proceeds
// Use for: Ban checks, onboarding verification, email verification
// Usage: Route::middleware(['custom-auth'])->group(...)
```

#### CustomAuthRedirectController
```php
// app/Http/Controllers/Auth/CustomAuthRedirectController.php
// Purpose: Handle custom redirects after login/register/logout
// Methods:
//   - handleLoginRedirect()
//   - handleRegisterRedirect()
//   - handleLogout()
//   - should2FABeRequired()
//   - validatePreLogin()
```

#### AuthenticationListener
```php
// app/Listeners/AuthenticationListener.php
// Purpose: Listen to authentication events
// Events handled:
//   - Login event
//   - Registered event
//   - Logout event
// Use for: Logging, post-auth actions, email sending
```

---

## Customization Points

### 1. Override Layouts

**Option A: Minimal Customization**
```blade
<!-- resources/views/vendor/starterkit/layouts/auth/particles.blade.php -->
@extends('starterkit::layouts.auth.particles')
<!-- Override sections as needed -->
```

**Option B: Full Override**
```bash
php artisan vendor:publish --tag=starterkit-views
# Edit: resources/views/vendor/starterkit/layouts/auth/particles.blade.php
```

### 2. Customize Assets

**Option A: CSS Variable Overrides**
```blade
<html style="--auth-primary: #00aaff; --auth-bg: #f8f9fa;">
```

**Option B: Custom CSS**
```css
/* In your app.css */
.starterkit-particles { background: linear-gradient(...); }
```

**Option C: Publish & Edit**
```bash
php artisan vendor:publish --tag=starterkit-assets --force
# Edit files in: public/vendor/artflow-studio/starterkit/assets/
```

### 3. Change Default Layout

```php
// config/starterkit.php
'layouts' => [
    'auth' => 'glass',  // Change from 'particles'
    'admin' => 'topnav', // Change from 'sidebar'
],
```

Or via `.env`:
```env
STARTERKIT_AUTH_LAYOUT=glass
STARTERKIT_ADMIN_LAYOUT=topnav
```

### 4. Add Custom Fortify Logic

```bash
# Publish customizations
php artisan vendor:publish --tag=starterkit-fortify-customizations

# Edit the published files:
# - app/Http/Middleware/CustomAuthMiddleware.php
# - app/Http/Controllers/Auth/CustomAuthRedirectController.php
# - app/Listeners/AuthenticationListener.php

# Register in EventServiceProvider
protected $listen = [
    Login::class => [AuthenticationListener::class],
];
```

### 5. Extend Package Routes

```php
// routes/web.php
use ArtflowStudio\StarterKit\Http\Controllers\Auth\CustomAuthRedirectController;

Route::middleware(['auth', 'custom-auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
```

---

## Development Workflow

### Local Setup for Development

```bash
# 1. Clone and enter directory
git clone https://github.com/artflow-studio/af-laravel-starter-kit.git
cd af-laravel-starter-kit

# 2. Install dependencies
composer install
npm install

# 3. Configure
cp .env.example .env
php artisan key:generate

# 4. Database
php artisan migrate

# 5. Start development servers (separate terminals)
php artisan serve              # Terminal 1: localhost:8000
npm run dev                    # Terminal 2: Vite watch mode
```

### Making Changes

```bash
# Edit layout files
# resources/views/layouts/auth/particles.blade.php

# Edit styles
# resources/css/auth/layouts/_particles.scss

# Edit scripts
# resources/js/auth/particles.js

# Changes auto-reload via Vite (npm run dev)

# Build for production
npm run build

# Package for distribution
php artisan package:build
```

### Testing Changes

```bash
# Test individual layout
php artisan serve
# Visit: http://localhost:8000/test/layouts

# Run unit tests
php artisan test
npm run test

# Test in sample app
composer install
php artisan starterkit:install
```

---

## Publishing Strategy

### Why This Approach?

The package uses an intentional publishing strategy:

**Published by default** (in `starterkit:install`):
- Views (so users can customize)
- Assets (so they can optimize if needed)
- Config (so they can configure)

**Published on demand** (optional tags):
- Docs (users may not need local copies)
- Migrations (optional database setup)
- Fortify customizations (advanced use case)

### Why NOT Publish Fortify Customizations by Default?

```
❌ NOT PUBLISHED BY DEFAULT BECAUSE:

1. Most users don't need them
   - Basic Fortify works fine for most apps
   - Adds complexity if not used

2. Prevents bloat
   - Only 3 files, but 3 extra files to maintain
   - If not using, they're just noise

3. Explicit is better than implicit
   - Users opt-in when they need advanced logic
   - Clear intent: "I need custom auth handling"

4. Keeps app cleaner
   - No unused middleware/controllers
   - No unused event listeners

5. Aligns with Laravel philosophy
   - "Rails magic" is good when you use it
   - Bloat is bad if you don't use it
```

### Best Practice for Users

```
Standard App (90% of cases):
✅ Use: php artisan starterkit:install
❌ Don't use: --tag=fortify-customizations

Advanced App (10% of cases):
✅ Use: php artisan starterkit:install
✅ Then: php artisan vendor:publish --tag=fortify-customizations
✅ Then: Implement custom auth logic
```

---

## Best Practices

### For Package Maintenance

#### 1. Keep Assets Pre-Built

**Why**: Users shouldn't need npm

**How**: Build assets before each release
```bash
npm run build
php artisan package:build
```

#### 2. Version Assets Carefully

**Issue**: Vite creates `auth2.js` when both `auth.css` and `auth.js` exist

**Solution**: `BuildPackageCommand` renames to clean names
```
auth2.js → auth.js
admin2.js → admin.js
```

#### 3. Test Publishing

Always test all publishing tags:
```bash
# Fresh Laravel app
composer create-project laravel/laravel test-app
cd test-app
composer require artflow-studio/starterkit
php artisan starterkit:install
php artisan serve
# Visit localhost:8000/test/layouts
```

#### 4. Document Configuration

Update `config/starterkit.php` when adding new options

### For Users

#### 1. Don't Modify Vendor Views

**Instead**: Publish and override
```bash
# Don't:
❌ vim vendor/artflow-studio/starterkit/resources/views/...

# Do:
✅ php artisan vendor:publish --tag=starterkit-views
✅ vim resources/views/vendor/starterkit/...
```

#### 2. Use Environment Variables for Config

```php
// config/starterkit.php
'layouts' => [
    'auth' => env('STARTERKIT_AUTH_LAYOUT', 'particles'),
],
```

#### 3. Extend, Don't Modify

```php
// Create new middleware that extends the package's
class MyCustomAuthMiddleware extends CustomAuthMiddleware {
    // Your logic here
}
```

#### 4. Keep Assets in Sync

If you customize CSS/JS, rebuild:
```bash
npm run build
# Or request from package maintainer
```

---

## Troubleshooting Guide

### Assets Not Loading

**Symptom**: Styles/scripts not applied, broken layout

**Diagnosis**:
```bash
# Check if assets published
ls public/vendor/artflow-studio/starterkit/assets/
# Should show: auth.css, auth.js, admin.css, admin.js

# Check if paths in config are correct
cat config/starterkit.php | grep assets
```

**Solutions**:
```bash
# 1. Reinstall assets
php artisan vendor:publish --tag=starterkit-assets --force

# 2. Clear cache
php artisan optimize:clear
php artisan config:cache

# 3. Check server
php artisan serve  # If using file server
```

### Layouts Not Displaying

**Symptom**: Blank page or 404 when visiting layout routes

**Diagnosis**:
```bash
# Check if views published
ls resources/views/vendor/starterkit/layouts/
# Should show: auth/ and admin/ directories

# Check test route
php artisan route:list | grep test
```

**Solutions**:
```bash
# 1. Publish views
php artisan vendor:publish --tag=starterkit-views --force

# 2. Check Blade cache
php artisan view:clear

# 3. Verify namespace in extends
# Should be: @extends('starterkit::layouts.auth.particles')
```

### Dark Mode Not Working

**Symptom**: Dark mode toggle doesn't change appearance

**Diagnosis**:
```blade
<!-- Check if HTML has attribute -->
<html data-bs-theme="light">  ✅ Correct
<html>                        ❌ Missing

<!-- Check Bootstrap CSS loaded -->
<!-- Should include Bootstrap CSS -->
```

**Solutions**:
```blade
<!-- 1. Add attribute to HTML -->
<html data-bs-theme="{{ $theme ?? 'light' }}">

<!-- 2. Verify Bootstrap is loading -->
@include('starterkit::components.auth-assets')

<!-- 3. Test JavaScript -->
<!-- In browser console: -->
document.documentElement.getAttribute('data-bs-theme')
```

### Fortify Not Installing

**Symptom**: Installation fails, Fortify commands not available

**Diagnosis**:
```bash
# Check Fortify installed
composer show | grep fortify
# Should show: laravel/fortify

# Check config/fortify.php exists
ls config/fortify.php
```

**Solutions**:
```bash
# 1. Install Fortify manually
composer require laravel/fortify

# 2. Install Fortify packages
php artisan fortify:install

# 3. Retry StarterKit install
php artisan starterkit:install

# 4. Check Fortify version compatibility
# App requires: laravel/fortify ^1.17
```

### Publishing Errors

**Symptom**: "Unable to locate publishable resources"

**Diagnosis**:
```bash
# List available tags
php artisan vendor:publish --list
```

**Solutions**:
```bash
# 1. Reinstall package
composer remove artflow-studio/starterkit
composer install
composer require artflow-studio/starterkit

# 2. Clear cache
php artisan cache:clear

# 3. Check composer.json
# "artflow-studio/starterkit" should be in require
```

---

## Extension Patterns

### Pattern 1: Custom Layout

**Goal**: Create a new custom layout variant

**Steps**:
```bash
# 1. Publish views
php artisan vendor:publish --tag=starterkit-views

# 2. Create new layout file
cp resources/views/vendor/starterkit/layouts/auth/particles.blade.php \
   resources/views/vendor/starterkit/layouts/auth/custom.blade.php

# 3. Edit custom.blade.php with your design

# 4. Use in your app
@extends('starterkit::layouts.auth.custom')
```

### Pattern 2: Themed Variants

**Goal**: Multiple color schemes for same layout

```blade
<!-- resources/views/starterkit/layouts/auth/particles.blade.php -->
@extends('starterkit::layouts.auth.particles')

@section('styles')
    <style>
        :root {
            @if($theme === 'blue')
                --primary: #00aaff;
                --secondary: #0066cc;
            @elseif($theme === 'red')
                --primary: #ff3333;
                --secondary: #cc0000;
            @endif
        }
    </style>
@endsection
```

### Pattern 3: Component Composition

**Goal**: Reuse components across layouts

```blade
<!-- components/auth-header.blade.php -->
<header class="auth-header">
    <h1>{{ $title }}</h1>
</header>

<!-- layouts/auth/custom.blade.php -->
@extends('starterkit::layouts.auth.base')

@section('content')
    @include('starterkit::components.auth-header', ['title' => 'Sign In'])
    <!-- Form here -->
@endsection
```

### Pattern 4: Middleware Extension

**Goal**: Add custom auth checks

```php
// app/Http/Middleware/EnhancedAuthMiddleware.php
namespace App\Http\Middleware;

use App\Http\Middleware\CustomAuthMiddleware;

class EnhancedAuthMiddleware extends CustomAuthMiddleware {
    public function handle($request, $next) {
        if ($request->user()) {
            // Your custom logic
            if ($request->user()->is_banned) {
                auth()->logout();
                return redirect('/');
            }
        }
        
        return parent::handle($request, $next);
    }
}
```

### Pattern 5: Event Extension

**Goal**: Add custom event handling

```php
// app/Listeners/CustomAuthListener.php
namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class CustomAuthListener {
    public function handle(Login $event) {
        $user = $event->user;
        
        // Your custom logic
        $user->update(['last_login_at' => now()]);
        
        // Trigger notifications, logs, etc.
        event(new UserLoggedIn($user));
    }
}

// Register in EventServiceProvider
protected $listen = [
    Login::class => [
        CustomAuthListener::class,
    ],
];
```

---

## Common Workflows

### Workflow 1: Fresh Installation

```bash
# 1. Create new Laravel project
composer create-project laravel/laravel myapp
cd myapp

# 2. Install StarterKit
composer require artflow-studio/starterkit

# 3. Run installer
php artisan starterkit:install

# 4. Configure (optional)
# Edit: config/starterkit.php
# Or: .env (STARTERKIT_AUTH_LAYOUT=glass)

# 5. Start developing
php artisan serve
# Visit: http://localhost:8000/login
```

### Workflow 2: Add to Existing App

```bash
# 1. Install package
composer require artflow-studio/starterkit

# 2. Publish assets only (if you already have views)
php artisan vendor:publish --tag=starterkit-assets

# 3. Use in existing views
@extends('starterkit::layouts.admin.sidebar')

# 4. Include assets
@include('starterkit::components.admin-assets')
```

### Workflow 3: Custom Auth Logic

```bash
# 1. Install package
composer require artflow-studio/starterkit
php artisan starterkit:install

# 2. Publish customizations
php artisan vendor:publish --tag=starterkit-fortify-customizations

# 3. Edit files
# - app/Http/Middleware/CustomAuthMiddleware.php
# - app/Http/Controllers/Auth/CustomAuthRedirectController.php
# - app/Listeners/AuthenticationListener.php

# 4. Register middleware/listeners
# In routes/web.php and app/Providers/EventServiceProvider.php

# 5. Test
php artisan serve
```

### Workflow 4: Multi-Tenant Setup

```php
// Service provider
public function boot() {
    $tenant = auth()->user()?->tenant;
    
    config(['starterkit.layouts.auth' => 
        $tenant?->default_layout ?? 'particles'
    ]);
}

// In blade
@extends('starterkit::layouts.auth.' . config('starterkit.layouts.auth'))
```

---

## Performance Considerations

### Asset Loading

**Pre-built assets** are optimized:
- Minified CSS/JS
- Gzipped (web server handles)
- No runtime compilation

**Typical sizes**:
- auth.css: 257 KB
- auth.js: 4 KB
- admin.css: 235 KB
- admin.js: 4 KB

**Total**: ~500 KB (one-time download, browser cached)

### View Rendering

All views are simple Blade templates:
- No runtime compilation needed
- Fast rendering (no special logic)
- Cached by Laravel's view compiler

### Database Impact

Package includes migrations for:
- Standard user table (already part of Laravel)
- Fortify tables (optional, requested by Fortify)

No automatic database operations beyond standard Fortify setup.

---

## Security Considerations

### Asset Integrity

Pre-built assets are:
- Compiled from source SCSS/JavaScript
- Minified for production
- Version-controlled
- Validated before release

### Fortify Integration

Package uses official Laravel Fortify:
- All security features included
- CSRF protection enabled
- Rate limiting available
- Optional 2FA support

### Custom Auth Code

The optional custom auth files follow Laravel best practices:
- Input validation included
- Proper exception handling
- CSRF token checking
- User data protection

### Publishing

Only publish what your app needs:
- Don't publish if not using
- Keep app surface minimal
- Review before using custom files

---

## Support & Resources

### Documentation Files Included

```
docs/
├── START_HERE.md                    # Quick start
├── LAYOUTS_DOCUMENTATION.html       # Interactive showcase
├── DARK_MODE_GUIDE.md               # Dark mode setup
├── SCSS_COMPONENTS_GUIDE.md         # CSS reference
└── FINAL_PROJECT_COMPLETION.md      # Complete overview
```

### External Resources

- **Laravel Docs**: https://laravel.com/docs
- **Bootstrap Docs**: https://getbootstrap.com/docs
- **Laravel Fortify**: https://laravel.com/docs/fortify
- **Blade Templates**: https://laravel.com/docs/blade

### Getting Help

1. Check local `docs/` directory
2. Visit `/test/layouts` route (after install)
3. Review `config/starterkit.php` comments
4. Check GitHub issues
5. Email support: support@artflow-studio.com

---

## Summary

**AF Laravel Starter Kit** is designed to be:

✅ **Easy to install** - One command, ready to go
✅ **Zero configuration** - Works out of the box
✅ **Highly customizable** - Override whatever you need
✅ **Optionally extensible** - Advanced features available on demand
✅ **Production-ready** - Pre-built, tested, optimized
✅ **Well-documented** - Comprehensive guides included

Use this guide as a reference when:
- Installing for the first time
- Customizing layouts or styles
- Adding custom authentication logic
- Troubleshooting issues
- Extending functionality
- Contributing improvements

**Happy building!** 🚀

---

**Document Version**: 1.0.0
**Package**: AF Laravel Starter Kit
**Last Updated**: November 2025
**Maintained by**: Artflow Studio
