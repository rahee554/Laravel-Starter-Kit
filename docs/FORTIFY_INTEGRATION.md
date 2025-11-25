# 📖 StarterKit - Fortify Integration Guide

**How to use StarterKit layouts with Laravel Fortify**

---

## Quick Start

After installing StarterKit, your authentication layouts are automatically published and ready to use.

```bash
composer require rahee554/laravel-starter-kit
php artisan starterkit:install
```

---

## Using Default Layout in Fortify Views

### Option 1: Using Config Helper (Recommended)

In your Fortify views (e.g., `resources/views/auth/login.blade.php`):

```blade
@extends(config('starterkit.auth_layout_view'))

@section('title', 'Login')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" required autofocus />
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required />
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Sign In</button>
    </form>
@endsection
```

### Option 2: Using Helper Class

```blade
@php
    $helper = new \ArtflowStudio\StarterKit\Helpers\StarterKitHelper;
    $defaultLayout = $helper::getDefaultAuthLayoutView();
@endphp

@extends($defaultLayout)

@section('title', 'Login')

@section('content')
    <!-- Your form here -->
@endsection
```

### Option 3: Direct Layout Reference

```blade
@extends('starterkit::layouts.starterkit.auth.particles')

@section('title', 'Login')

@section('content')
    <!-- Your form here -->
@endsection
```

---

## Available Auth Layouts

| Layout | Usage | Best For |
|--------|-------|----------|
| `particles` | `@extends('starterkit::layouts.starterkit.auth.particles')` | Modern, animated background |
| `centered` | `@extends('starterkit::layouts.starterkit.auth.centered')` | Classic, simple approach |
| `split` | `@extends('starterkit::layouts.starterkit.auth.split')` | Side-by-side layout |
| `minimal` | `@extends('starterkit::layouts.starterkit.auth.minimal')` | Clean, minimal design |
| `glass` | `@extends('starterkit::layouts.starterkit.auth.glass')` | Glassmorphism effect |
| `hero` | `@extends('starterkit::layouts.starterkit.auth.hero')` | Large hero section |
| `modern` | `@extends('starterkit::layouts.starterkit.auth.modern')` | Contemporary design |
| `3d` | `@extends('starterkit::layouts.starterkit.auth.3d')` | 3D effects |
| `premium-dark` | `@extends('starterkit::layouts.starterkit.auth.premium-dark')` | Dark theme |
| `gradient-flow` | `@extends('starterkit::layouts.starterkit.auth.gradient-flow')` | Animated gradients |
| `clean` | `@extends('starterkit::layouts.starterkit.auth.clean')` | Minimalist |
| `hero-grid` | `@extends('starterkit::layouts.starterkit.auth.hero-grid')` | Grid-based hero |
| `sidebar` | `@extends('starterkit::layouts.starterkit.auth.sidebar')` | Sidebar navigation |
| `base` | `@extends('starterkit::layouts.starterkit.auth.base')` | Minimal HTML only |

---

## Changing Default Layout

### At Installation Time

```bash
php artisan starterkit:install --layout=split
```

### After Installation

Edit `.env`:

```env
STARTERKIT_AUTH_LAYOUT=split
STARTERKIT_ADMIN_LAYOUT=sidebar
```

Or edit `config/starterkit.php`:

```php
'auth_layout' => env('STARTERKIT_AUTH_LAYOUT', 'modern'),
'admin_layout' => env('STARTERKIT_ADMIN_LAYOUT', 'sidebar'),
```

---

## Available Sections in Layouts

### Standard Sections (All Auth Layouts Support)

```blade
@extends('starterkit::layouts.starterkit.auth.particles')

@section('title')
    Login to Your Account
@endsection

@section('description')
    Optional: Short description of what this form is for
@endsection

@section('content')
    <!-- Your form fields go here -->
@endsection

@section('footer-links')
    <a href="{{ route('register') }}">Create account</a>
    <a href="{{ route('password.request') }}">Forgot password?</a>
@endsection
```

### Layout-Specific Sections

#### Hero Layouts (`hero`, `hero-grid`)

```blade
@section('hero-title')
    Welcome to Our App
@endsection

@section('hero-description')
    Build amazing things with secure authentication
@endsection

@section('hero-features')
    <li>Secure and reliable</li>
    <li>Two-factor authentication</li>
    <li>Email verification</li>
@endsection
```

---

## Customizing Styles

### Option 1: Override CSS (Recommended)

Create `resources/css/starterkit-custom.css`:

```css
/* Override StarterKit styles */
.auth-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
}

.auth-header h1 {
    font-size: 2.5rem;
    font-weight: bold;
}
```

Include in your Blade layout:

```blade
<link rel="stylesheet" href="{{ asset('css/starterkit-custom.css') }}">
```

### Option 2: Modify Published Layouts

The layouts are published to `resources/views/layouts/starterkit/auth/`.

Edit them directly to customize:

```bash
resources/views/layouts/starterkit/auth/particles.blade.php
resources/views/layouts/starterkit/auth/centered.blade.php
# ... etc
```

### Option 3: Create Custom Layout

Create `resources/views/layouts/auth/custom.blade.php`:

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    @include('starterkit::components.auth-assets')
</head>
<body class="custom-auth-layout">
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
```

---

## Publishing Fortify Views

To publish and customize Fortify's default views:

```bash
php artisan vendor:publish --tag=laravel-fortify --force
```

This creates views in `resources/views/auth/` that you can customize.

Then extend your StarterKit layout:

```blade
{{-- resources/views/auth/login.blade.php --}}
@extends('starterkit::layouts.starterkit.auth.particles')

@section('title', 'Login')

@section('content')
    @include('auth._form-login')
@endsection
```

---

## Registering Custom Middleware

After installation, register the `CustomAuthMiddleware` in your kernel:

**File**: `app/Http/Kernel.php`

```php
protected $routeMiddleware = [
    // ... other middleware
    'custom-auth' => \App\Http\Middleware\CustomAuthMiddleware::class,
];
```

Usage in routes:

```php
Route::middleware(['auth', 'custom-auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
```

---

## Listening to Auth Events

StarterKit publishes `AuthenticationListener` to handle auth events.

**File**: `app/Listeners/AuthenticationListener.php`

Register in `app/Providers/EventServiceProvider.php`:

```php
protected $listen = [
    'Illuminate\Auth\Events\Login' => [
        'App\Listeners\AuthenticationListener',
    ],
    'Illuminate\Auth\Events\Logout' => [
        'App\Listeners\AuthenticationListener',
    ],
];
```

---

## Using Admin Layouts

Similar to auth layouts, admin layouts are available at:

```blade
@extends('starterkit::layouts.starterkit.admin.sidebar')

@section('header_title', 'Dashboard')

@section('content')
    <!-- Admin content -->
@endsection
```

### Available Admin Layouts

| Layout | Usage |
|--------|-------|
| `sidebar` | Classic sidebar navigation |
| `topnav` | Horizontal top navigation |
| `minimal` | Clean minimalist |
| `neo` | Modern futuristic |
| `classic` | Traditional admin panel |

---

## Troubleshooting

### Layouts Not Found

**Error**: "View [starterkit::layouts.starterkit.auth.particles] not found"

**Solution**:
1. Run install command: `php artisan starterkit:install`
2. Check published layouts exist in `resources/views/layouts/starterkit/auth/`
3. Clear view cache: `php artisan view:clear`

### Assets Not Loading (Unstyled Pages)

**Error**: Page loads but no CSS/JS

**Solution**:
1. Verify assets are published: `php artisan vendor:publish --tag=starterkit-assets --force`
2. Check `public/vendor/artflow-studio/starterkit/assets/auth.css` exists
3. Clear browser cache
4. Run: `php artisan config:clear`

### Middleware Not Working

**Error**: CustomAuthMiddleware not registered

**Solution**:
1. Register in `app/Http/Kernel.php`
2. Use in routes: `Route::middleware(['custom-auth'])`
3. Check `app/Http/Middleware/CustomAuthMiddleware.php` was published

### Default Layout Not Changing

**Error**: Layout still shows particles after changing .env

**Solution**:
1. Clear config cache: `php artisan config:clear`
2. Verify .env has correct value: `STARTERKIT_AUTH_LAYOUT=split`
3. Restart server if using `php artisan serve`

---

## Helper Methods

Access available layouts in code:

```php
<?php

use ArtflowStudio\StarterKit\Helpers\StarterKitHelper;

// Get default auth layout view path
$view = StarterKitHelper::getDefaultAuthLayoutView();
// Returns: "starterkit::layouts.starterkit.auth.particles"

// Get all available auth layouts
$layouts = StarterKitHelper::getAvailableAuthLayouts();
// Returns: [
//   'centered' => 'Centered Box Layout',
//   'split' => 'Split Screen with Branding',
//   ...
// ]

// Get default admin layout
$adminView = StarterKitHelper::getDefaultAdminLayoutView();

// Get all available admin layouts
$adminLayouts = StarterKitHelper::getAvailableAdminLayouts();
```

---

## Blade Directives

StarterKit provides helpful Blade directives:

```blade
<!-- Get default auth layout -->
@starterKitDefaultAuthLayout

<!-- Get default admin layout -->
@starterKitDefaultAdminLayout

<!-- Get JSON of all auth layouts -->
@starterKitAuthLayouts

<!-- Get JSON of all admin layouts -->
@starterKitAdminLayouts
```

---

## Next Steps

1. ✅ Install: `composer require rahee554/laravel-starter-kit`
2. ✅ Setup: `php artisan starterkit:install`
3. ✅ Customize: Edit `resources/views/layouts/starterkit/auth/`
4. ✅ Register: Add middleware to `app/Http/Kernel.php`
5. ✅ Test: Visit `/login` to see your styled pages

---

## Support

For issues and questions:
- 📖 Documentation: Check `docs/` folder
- 🐛 Issues: Report on GitHub
- 💬 Questions: Start a discussion

---

**Happy Authenticating! 🎉**
