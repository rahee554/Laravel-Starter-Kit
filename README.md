# AF Laravel Starter Kit

[![Latest Version](https://img.shields.io/badge/version-0.2.0-blue.svg)](https://github.com/rahee554/Laravel-Starter-Kit)
[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.8-purple.svg)](https://getbootstrap.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE.md)

**Complete Laravel Authentication & Admin Starter Kit with Built-in Fortify Integration**

> 13 Beautiful Auth Layouts | 5 Admin Layouts | Zero Build Required | Bootstrap 5.3.8 | Dark Mode | Complete Fortify Integration | Auto-Registered Services

A complete, professionally designed Laravel package with **13 authentication layouts**, **5 admin dashboard layouts**, Bootstrap 5.3.8, native dark mode, **complete Laravel Fortify integration**, and **automatic authentication services**. Pre-built assets mean **zero npm/build step required** after installation!

---

## ✨ Key Features

- 🎨 **18 Total Layouts** - 13 authentication + 5 admin professionally designed layouts
- 🌙 **Dark Mode** - Native Bootstrap dark mode with smooth transitions  
- 📱 **Fully Responsive** - Mobile-first design, works on all devices
- 🚀 **Bootstrap 5.3.8** - Latest Bootstrap with custom form controls
- ⚡ **Pre-Built Assets** - No npm/build step required for installation!
- 🔐 **Complete Fortify Integration** - All authentication scaffolding included
- 🎭 **Animated Effects** - Particles, gradients, and smooth transitions (pure CSS)
- 🎛️ **Customizable** - Easy to modify colors, layouts, and components
- 📚 **Complete Documentation** - Comprehensive docs and guides included
- 🧹 **Clean Installation** - Minimal setup, optional customizations available
- **✅ NEW: Auto-Registered Services** - AuthService, Middleware, Listeners, Actions all automatic
- **✅ NEW: One-Command Installation** - `php artisan starterkit:install` does everything

---

## 🆕 What's New in v0.2

### Complete Fortify Integration

The package now includes **all Fortify customizations** automatically registered:

#### 🔧 **AuthService** - Central Authentication Logic
```php
// Automatic hooks for custom auth logic
AuthService::redirectAfterLogin($user)           // Role-based login redirects
AuthService::redirectAfterRegister($user)        // Post-registration routing
AuthService::beforeLogin($request)               // Pre-login validation
AuthService::afterLogin($user, $request)         // Post-login hooks
AuthService::afterRegister($user, $request)      // Post-registration hooks
AuthService::beforeLogout($user)                 // Pre-logout logic
AuthService::afterLogout($user)                  // Post-logout logic
AuthService::shouldRequireTwoFactor($user)       // 2FA requirement check
AuthService::getCustomRegistrationRules()        // Custom validation rules
AuthService::sanitizeRegistrationData($data)     // Data sanitization
```

#### 🎬 **Fortify Actions** - Authentication Event Handlers
All automatic, no configuration needed:
- `CreateNewUser` - Registers new users with custom hooks
- `UpdateUserPassword` - Handles password changes
- `UpdateUserProfileInformation` - Manages profile updates
- `ResetUserPassword` - Processes password resets
- `PasswordValidationRules` - Centralized validation logic

#### 🛡️ **CustomAuthMiddleware** - Route Protection
```php
// Use in routes for custom auth checks
Route::middleware(['custom-auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});
```

#### 👂 **AuthenticationListener** - Event Listeners
```php
// Automatically listens to:
- Login events
- Registered events  
- Logout events
// Register in EventServiceProvider to hook into auth events
```

#### ⚙️ **StarterKitFortifyServiceProvider**
- Automatically registered by main ServiceProvider
- Registers all Fortify actions
- Sets up view responses
- Configures rate limiting

### One-Command Installation

```bash
php artisan starterkit:install
```

This automatically:
1. ✅ Installs Laravel Fortify (if not already installed)
2. ✅ Publishes 13 auth layouts
3. ✅ Publishes pre-built assets
4. ✅ Publishes configuration
5. ✅ Registers authentication services
6. ✅ Sets up layout test routes
7. ✅ Updates `.env` with defaults

---

## 📦 Installation

### 1. Install via Composer

```bash
composer require rahee554/laravel-starter-kit
```

### 2. Run Installation Command

```bash
php artisan starterkit:install
```

This single command handles:
- Fortify installation (if needed)
- Asset publishing (CSS/JS)
- View publishing (13 auth layouts)
- Configuration setup
- Environment configuration
- Route registration

**No npm build required!** Assets are pre-compiled.

### 3. Setup Database

```bash
# Configure .env with your database
php artisan migrate
```

### 4. Start Using

Visit `/login` to see your authentication pages!
Visit `/test/layouts` to preview all 18 layouts!

---

## 🎨 Available Layouts

### Authentication Layouts (13 Options)

| Layout | Best For | Features |
|--------|----------|----------|
| **particles** | Modern feel | Animated particles, connecting lines |
| **centered** | Classic login | Simple centered form |
| **split** | Brand showcase | Side-by-side layout |
| **glass** | Contemporary | Glassmorphism effect |
| **hero** | Marketing | Large hero section |
| **modern** | Professional | Contemporary design |
| **3d** | Creative | 3D effects |
| **premium-dark** | Luxury | Dark theme |
| **gradient-flow** | Dynamic | Animated gradients |
| **minimal** | Clean | Ultra-simple |
| **clean** | Business | Professional design |
| **hero-grid** | Modern | Grid-based |
| **sidebar** | Navigation | Sidebar style |

### Admin Layouts (5 Options)

| Layout | Best For | Features |
|--------|----------|----------|
| **sidebar** | Dashboards | Collapsible sidebar |
| **topnav** | Web apps | Horizontal navigation |
| **minimal** | Analytics | Content-focused |
| **neo** | Modern | Glassmorphic design |
| **classic** | Enterprise | Traditional design |

### Preview Layouts

```bash
# After installation, visit in browser:
http://localhost:8000/test/layouts
```

---

## 🔐 Authentication Flow

### How Fortify Integration Works

The package includes complete Fortify integration that's **automatically registered**:

```
User Action
    ↓
Fortify Guard → CustomAuthMiddleware
    ↓
Fortify Action (CreateNewUser, etc.)
    ↓
AuthService Hook (business logic)
    ↓
AuthenticationListener (events)
    ↓
CustomAuthRedirectController (routing)
    ↓
View Rendered with Layout
```

### Extending Authentication

Override `AuthService` methods for custom logic:

```php
// In app/Services/AuthService.php (published with install command)

public static function redirectAfterLogin($user)
{
    if ($user->isAdmin()) {
        return redirect('/admin/dashboard');
    }
    
    if (!$user->email_verified_at) {
        return redirect('/email/verify');
    }
    
    return redirect('/dashboard');
}
```

---

## 🌙 Dark Mode

All layouts support native Bootstrap dark mode:

```blade
<!-- Light theme (default) -->
<html data-bs-theme="light">

<!-- Dark theme -->
<html data-bs-theme="dark">
```

JavaScript to toggle:

```javascript
function toggleTheme() {
    const html = document.documentElement;
    const current = html.getAttribute('data-bs-theme') || 'light';
    const next = current === 'dark' ? 'light' : 'dark';
    
    html.setAttribute('data-bs-theme', next);
    localStorage.setItem('theme', next);
}

// Load saved theme
window.addEventListener('load', () => {
    const saved = localStorage.getItem('theme');
    if (saved) {
        document.documentElement.setAttribute('data-bs-theme', saved);
    }
});
```

---

## ⚙️ Configuration

### Default Configuration

Edit `config/starterkit.php`:

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

### Environment Variables

```env
STARTERKIT_AUTH_LAYOUT=glass              # Default auth layout
STARTERKIT_ADMIN_LAYOUT=topnav            # Default admin layout
STARTERKIT_DARK_MODE_ENABLED=true         # Dark mode available
STARTERKIT_DARK_MODE_DEFAULT=light        # Default theme
```

---

## 🛠️ Publishing Tags

### Default Publishing (Automatic)

```bash
# These publish automatically with: php artisan starterkit:install

php artisan vendor:publish --tag=starterkit-auth-layouts    # Auth views (13 layouts)
php artisan vendor:publish --tag=starterkit-assets          # CSS/JS files
php artisan vendor:publish --tag=starterkit-config          # config/starterkit.php
```

### Optional Publishing

```bash
# Admin layouts (not needed for basic auth)
php artisan vendor:publish --tag=starterkit-admin-layouts

# Database migrations
php artisan vendor:publish --tag=starterkit-migrations

# Documentation
php artisan vendor:publish --tag=starterkit-docs

# Fortify configuration (if you need to customize Fortify)
php artisan vendor:publish --tag=starterkit-fortify-config
```

---

## 🎯 Usage Examples

### Use Authentication Layout

```blade
<!-- resources/views/auth/login.blade.php -->
@extends('starterkit::layouts.auth.login')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Sign In</button>
    </form>
@endsection
```

### Use Admin Layout

```blade
<!-- resources/views/dashboard.blade.php -->
@extends('starterkit::layouts.admin.sidebar')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <h1>Welcome to Dashboard</h1>
        <!-- Your content here -->
    </div>
@endsection
```

### Custom Middleware

```php
// routes/web.php
Route::middleware(['custom-auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});
```

### Handle Auth Events

```php
// app/Providers/EventServiceProvider.php
protected $listen = [
    \Illuminate\Auth\Events\Login::class => [
        \App\Listeners\AuthenticationListener::class,
    ],
    \Illuminate\Auth\Events\Registered::class => [
        \App\Listeners\AuthenticationListener::class,
    ],
    \Illuminate\Auth\Events\Logout::class => [
        \App\Listeners\AuthenticationListener::class,
    ],
];
```

---

## 📂 Package Structure

```
package/
├── src/
│   ├── Console/
│   │   ├── InstallCommand.php              # Main installation
│   │   └── PublishCommand.php              # Publishing helper
│   │
│   ├── Services/
│   │   └── AuthService.php                 # Auth logic & hooks
│   │
│   ├── Http/
│   │   ├── Controllers/Auth/
│   │   │   └── CustomAuthRedirectController.php  # Redirect logic
│   │   └── Middleware/
│   │       └── CustomAuthMiddleware.php    # Route protection
│   │
│   ├── Listeners/
│   │   └── AuthenticationListener.php      # Event listeners
│   │
│   ├── Actions/Fortify/
│   │   ├── CreateNewUser.php               # User creation
│   │   ├── CreateNewUserWithHooks.php      # User creation with hooks
│   │   ├── UpdateUserPassword.php          # Password updates
│   │   ├── UpdateUserProfileInformation.php # Profile updates
│   │   ├── ResetUserPassword.php           # Password resets
│   │   └── PasswordValidationRules.php     # Validation
│   │
│   ├── Providers/
│   │   ├── StarterKitServiceProvider.php   # Main provider
│   │   └── StarterKitFortifyServiceProvider.php # Fortify setup
│   │
│   └── StarterKitServiceProvider.php
│
├── resources/
│   ├── views/layouts/starterkit/
│   │   ├── auth/                    # 13 authentication layouts
│   │   │   ├── centered.blade.php
│   │   │   ├── split.blade.php
│   │   │   ├── glass.blade.php
│   │   │   ├── particles.blade.php
│   │   │   ├── hero.blade.php
│   │   │   ├── modern.blade.php
│   │   │   ├── 3d.blade.php
│   │   │   ├── premium-dark.blade.php
│   │   │   ├── gradient-flow.blade.php
│   │   │   ├── minimal.blade.php
│   │   │   ├── clean.blade.php
│   │   │   ├── hero-grid.blade.php
│   │   │   └── sidebar.blade.php
│   │   │
│   │   └── admin/                   # 5 admin layouts
│   │       ├── sidebar.blade.php
│   │       ├── topnav.blade.php
│   │       ├── minimal.blade.php
│   │       ├── neo.blade.php
│   │       └── classic.blade.php
│   │
│   └── css/ (SCSS source for dev)
│
├── public/vendor/artflow-studio/starterkit/
│   └── assets/                      # Pre-built production assets
│       ├── auth.css (257 KB)
│       ├── auth.js
│       ├── admin.css (235 KB)
│       └── admin.js
│
├── config/
│   └── starterkit.php               # Configuration
│
├── database/
│   └── migrations/                  # Database setup
│
├── docs/
│   ├── START_HERE.md
│   ├── LAYOUTS_DOCUMENTATION.html
│   ├── DARK_MODE_GUIDE.md
│   ├── SCSS_COMPONENTS_GUIDE.md
│   └── FINAL_PROJECT_COMPLETION.md
│
├── routes/
│   └── test-layouts.php             # Layout testing routes
│
├── composer.json                    # Package metadata
└── README.md                        # This file
```

---

## 📋 All Available Commands

### Installation

```bash
php artisan starterkit:install                    # Standard install
php artisan starterkit:install --layout=glass     # Custom layout
php artisan starterkit:install --force            # Overwrite existing
```

### Publishing

```bash
# Auto-published by install command:
php artisan vendor:publish --tag=starterkit-auth-layouts
php artisan vendor:publish --tag=starterkit-assets
php artisan vendor:publish --tag=starterkit-config

# Optional (not published by default):
php artisan vendor:publish --tag=starterkit-admin-layouts
php artisan vendor:publish --tag=starterkit-migrations
php artisan vendor:publish --tag=starterkit-docs
```

---

## 🧪 Testing

### Manual Layout Testing

```bash
php artisan serve
# Visit: http://localhost:8000/test/layouts
```

All 18 layouts are displayed with live switching options.

### Unit Tests

```bash
php artisan test
```

---

## 🐛 Troubleshooting

### Assets Not Loading

```bash
php artisan optimize:clear
php artisan starterkit:install --force
ls public/vendor/artflow-studio/starterkit/assets/
```

### Layouts Not Showing

```bash
php artisan vendor:publish --tag=starterkit-auth-layouts
ls resources/views/vendor/starterkit/layouts/
```

### Fortify Not Working

```bash
php artisan fortify:install
php artisan migrate
php artisan starterkit:install
```

### Permission Issues

```bash
chmod -R 755 storage bootstrap/cache
php artisan starterkit:install --force
```

---

## 🔧 Requirements

- **PHP**: 8.1+
- **Laravel**: 11.x
- **Laravel Fortify**: ^1.17
- **Bootstrap**: 5.3.8
- **Composer**: 2.x+

---

## 📊 What's Included

### ✅ Layouts (18 Total)
- 13 authentication layouts (responsive, dark mode)
- 5 admin dashboard layouts (responsive, dark mode)

### ✅ Assets (Pre-built)
- Auth CSS (257 KB) + JS (4 KB)
- Admin CSS (235 KB) + JS (4 KB)
- Bootstrap 5.3.8 integration
- Zero build required!

### ✅ Services
- AuthService with complete hook system
- CustomAuthMiddleware for route protection
- AuthenticationListener for events
- 6 Fortify actions with customization

### ✅ Documentation
- Interactive layout showcase
- Quick start guide
- Dark mode implementation guide
- Complete Fortify integration docs
- SCSS components reference

### ✅ Database
- User table migrations
- Auth tables setup

---

## 🚀 Development

### Local Setup

```bash
git clone https://github.com/rahee554/Laravel-Starter-Kit.git
cd Laravel-Starter-Kit
composer install
npm install

cp .env.example .env
php artisan key:generate

php artisan migrate
php artisan serve
npm run dev
```

### Build Commands

```bash
npm run build           # Production build
php artisan test        # Run tests
npm run test            # JS tests
```

---

## 📄 License

MIT License - Free to use in your projects!

---

## 🤝 Support

For help:
1. Check `docs/` directory
2. Review `LAYOUTS_DOCUMENTATION.html`
3. Visit `/test/layouts` route
4. Check Laravel Fortify docs

---

## 📊 Package Information

**AF Laravel Starter Kit**
- **Version**: 0.2.0 (with Fortify integration)
- **Laravel**: 11.x+
- **PHP**: 8.1+
- **Bootstrap**: 5.3.8
- **License**: MIT
- **Repository**: https://github.com/rahee554/Laravel-Starter-Kit
- **Owner**: rahee554

---

**Ready to build secure Laravel applications with beautiful layouts?** 🚀

Start with **AF Laravel Starter Kit** today!
