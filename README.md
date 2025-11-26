# AF Laravel Starter Kit

[![Latest Version](https://img.shields.io/badge/version-0.3.0-blue.svg)](https://github.com/artflow-studio/starterkit)
[![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![Fortify](https://img.shields.io/badge/Fortify-Latest-orange.svg)](https://laravel.com/docs/fortify)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.8-purple.svg)](https://getbootstrap.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE.md)

**Complete Laravel Authentication & Admin Starter Kit with Advanced Fortify Integration**

> 14 Beautiful Auth Layouts | 5 Admin Layouts | Zero Build Required | Bootstrap 5.3.8 | Dark Mode | **20 Fortify Response Contracts** | **Role-Based Redirects** | Complete Fortify Integration | Spatie Permission Support

A professional Laravel package with **14 authentication layouts**, **5 admin dashboard layouts**, Bootstrap 5.3.8, native dark mode, and **complete Laravel Fortify integration** including all 20 response contracts. Pre-built assets mean **zero npm/build step required** after installation!

---

## ✨ Key Features

- 🎨 **19 Total Layouts** - 14 authentication + 5 admin professionally designed layouts
- 🌙 **Dark Mode** - Native Bootstrap dark mode with smooth transitions  
- 📱 **Fully Responsive** - Mobile-first design, works on all devices
- 🚀 **Bootstrap 5.3.8** - Latest Bootstrap with custom form controls
- ⚡ **Pre-Built Assets** - No npm/build step required for installation!
- 🔐 **Complete Fortify Integration** - All 20 response contracts implemented
- 🛡️ **Role-Based Redirects** - Built-in Spatie Laravel Permission support
- 🎭 **Animated Effects** - Particles, gradients, and smooth transitions (pure CSS)
- 🎛️ **Customizable** - Easy to modify colors, layouts, and components
- 📚 **Complete Documentation** - Comprehensive docs and guides included
- 🧹 **Clean Installation** - Minimal setup, optional customizations available
- **✅ AuthService** - Centralized authentication logic with hooks
- **✅ 20 Response Contracts** - All Fortify responses fully implemented
- **✅ One-Command Installation** - `php artisan starterkit:install` does everything

---

## 🆕 What's New in v0.3

### Complete Fortify Response Contract Coverage

The package now implements **all 20 Fortify response contracts**, giving you total control over every authentication response:

#### ✅ All Response Contracts Implemented

**Authentication Responses (4)**
- `LoginResponse` - Role-based redirects via AuthService
- `RegisterResponse` - Post-registration routing via AuthService  
- `LogoutResponse` - Logout handling
- `TwoFactorLoginResponse` - 2FA completion redirects

**Password Management (7)**
- `PasswordResetResponse` - After password reset
- `PasswordUpdateResponse` - After password change
- `PasswordConfirmedResponse` - Password confirmation success
- `SuccessfulPasswordResetLinkRequestResponse` - Reset link sent
- `FailedPasswordResetLinkRequestResponse` - Reset link failed
- `FailedPasswordResetResponse` - Reset failed
- `FailedPasswordConfirmationResponse` - Wrong password

**Profile Management (1)**
- `ProfileInformationUpdatedResponse` - Profile updated

**Two-Factor Authentication (5)**
- `TwoFactorEnabledResponse` - 2FA enabled
- `TwoFactorDisabledResponse` - 2FA disabled
- `TwoFactorConfirmedResponse` - 2FA confirmed
- `RecoveryCodesGeneratedResponse` - Recovery codes generated
- `FailedTwoFactorLoginResponse` - Invalid 2FA code

**Email Verification (2)**
- `VerifyEmailResponse` - Email verified
- `EmailVerificationNotificationSentResponse` - Verification email sent

**Rate Limiting (1)**
- `LockoutResponse` - Too many login attempts

### Advanced AuthService with Role-Based Redirects

```php
// Automatic Spatie Laravel Permission detection
AuthService::redirectAfterLogin($user)
    ↓
    Checks roles:
    - admin? → /admin/dashboard
    - moderator? → /moderator/dashboard
    - manager? → /manager/dashboard
    - else → /dashboard
```

### Package File Structure

All authentication logic is now properly organized in the package:

```
vendor/artflow-studio/starterkit/src/
├── Http/
│   ├── Responses/                    ✅ 20 Fortify response implementations
│   │   ├── LoginResponse.php
│   │   ├── RegisterResponse.php
│   │   ├── LogoutResponse.php
│   │   ├── TwoFactorLoginResponse.php
│   │   ├── PasswordResetResponse.php
│   │   ├── VerifyEmailResponse.php
│   │   └── ... (14 more)
│   └── Middleware/
│       └── CustomAuthMiddleware.php
├── Services/
│   └── AuthService.php              ✅ Role-based auth logic
├── Providers/
│   └── StarterKitFortifyServiceProvider.php  ✅ Binds all 20 responses
└── Console/
    └── InstallCommand.php           ✅ Enhanced with --publish-auth-service
```

**Important:** These files are in the **package only**, not in your application. The install command optionally publishes AuthService to `app/Services/` for customization.

---

## 📦 Installation

### Quick Start (3 Steps)

```bash
# 1. Install via Composer
composer require artflow-studio/starterkit

# 2. Run installation command
php artisan starterkit:install

# 3. Start the server
php artisan serve
```

Then visit:
- **Login/Register:** http://localhost:8000/login
- **Layout Showcase:** http://localhost:8000/test/layouts

### Installation Options

```bash
# Basic installation (default)
php artisan starterkit:install

# Choose auth layout during installation
php artisan starterkit:install --layout=glass

# Publish AuthService to app/Services for customization
php artisan starterkit:install --publish-auth-service

# Force overwrite existing files
php artisan starterkit:install --force

# Combine options
php artisan starterkit:install --publish-auth-service --force
```

### What Gets Installed

The install command automatically:
1. ✅ Checks and installs Laravel Fortify (if needed)
2. ✅ Publishes 14 auth layouts
3. ✅ Publishes 5 admin layouts
4. ✅ Publishes pre-built CSS/JS assets (no npm build needed!)
5. ✅ Publishes configuration (`config/starterkit.php`)
6. ✅ Registers custom Fortify responses (20 contracts)
7. ✅ Sets up layout test routes (`/test/layouts`)
8. ✅ Updates `.env` with `STARTERKIT_AUTH_LAYOUT` and `STARTERKIT_ADMIN_LAYOUT`
9. ✅ Optionally publishes AuthService to `app/Services/` for customization

### Database Setup

```bash
# Run Laravel migrations
php artisan migrate
```

This creates the users table and related tables needed for authentication.

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

## 🔐 Fortify Response Contracts

### All 20 Response Contracts Implemented

The package implements **all Fortify response contracts** for complete control over authentication responses:

#### Location
```
vendor/artflow-studio/starterkit/src/Http/Responses/
```

#### Complete Contract List
```
✅ LoginResponse                                 - Login success
✅ RegisterResponse                              - Registration success
✅ LogoutResponse                                - Logout
✅ TwoFactorLoginResponse                        - 2FA login success
✅ PasswordResetResponse                         - Password reset success
✅ PasswordUpdateResponse                        - Password update
✅ PasswordConfirmedResponse                     - Password confirmation
✅ ProfileInformationUpdatedResponse             - Profile update
✅ VerifyEmailResponse                           - Email verification
✅ TwoFactorEnabledResponse                      - 2FA enabled
✅ TwoFactorDisabledResponse                     - 2FA disabled
✅ TwoFactorConfirmedResponse                    - 2FA confirmed
✅ RecoveryCodesGeneratedResponse                - Recovery codes generated
✅ SuccessfulPasswordResetLinkRequestResponse    - Reset link sent
✅ FailedPasswordResetLinkRequestResponse        - Reset link failed
✅ FailedPasswordResetResponse                   - Reset failed
✅ FailedPasswordConfirmationResponse            - Confirmation failed
✅ FailedTwoFactorLoginResponse                  - 2FA failed
✅ EmailVerificationNotificationSentResponse     - Verification email sent
✅ LockoutResponse                               - Rate limiting lockout
```

#### Automatic Binding

All responses are automatically bound in `StarterKitFortifyServiceProvider`:

```php
// vendor/artflow-studio/starterkit/src/Providers/StarterKitFortifyServiceProvider.php

public function register(): void
{
    // All 20 response contracts are bound here
    $this->app->singleton(LoginResponse::class, StarterKitLoginResponse::class);
    $this->app->singleton(RegisterResponse::class, StarterKitRegisterResponse::class);
    // ... + 18 more
}
```

---

## 🧠 AuthService - Role-Based Authentication

### Location
```
vendor/artflow-studio/starterkit/src/Services/AuthService.php
```

### Features

The AuthService provides centralized authentication logic:

```php
// Role-based redirects (automatic Spatie support)
AuthService::redirectAfterLogin($user, $request)

// Post-registration routing
AuthService::redirectAfterRegister($user, $request)

// Password reset redirect
AuthService::redirectAfterPasswordReset($user)

// Pre-login validation
AuthService::beforeLogin($request)

// Post-login hooks
AuthService::afterLogin($user, $request)

// Post-registration hooks
AuthService::afterRegister($user, $request)

// Pre-logout validation
AuthService::beforeLogout($user)

// Post-logout hooks
AuthService::afterLogout($user)

// Check if 2FA required
AuthService::shouldRequireEmailVerification($user)
```

### Built-In Spatie Laravel Permission Support

The AuthService automatically detects and uses Spatie roles:

```php
public static function redirectAfterLogin(Model $user, ?Request $request = null): string
{
    // Check if Spatie is available
    if (method_exists($user, 'hasRole')) {
        // Admin users
        if ($user->hasRole('admin')) {
            return '/admin/dashboard';
        }
        
        // Moderators
        if ($user->hasRole('moderator')) {
            return '/moderator/dashboard';
        }
        
        // Managers
        if ($user->hasRole('manager')) {
            return '/manager/dashboard';
        }
    }
    
    // Default for all other users
    return '/dashboard';
}
```

### Publishing AuthService

To customize the AuthService for your application:

```bash
php artisan starterkit:install --publish-auth-service
```

This creates:
- `app/Services/AuthService.php` - Your customizable copy
- Namespace: `App\Services`
- Instructions for updating response imports

### After Publishing

Update these response files to use your published `App\Services\AuthService`:

1. `vendor/artflow-studio/starterkit/src/Http/Responses/LoginResponse.php`
2. `vendor/artflow-studio/starterkit/src/Http/Responses/RegisterResponse.php`
3. `vendor/artflow-studio/starterkit/src/Http/Responses/TwoFactorLoginResponse.php`

Change import from:
```php
use ArtflowStudio\StarterKit\Services\AuthService;
```

To:
```php
use App\Services\AuthService;
```

### Custom Example

```php
// app/Services/AuthService.php

namespace App\Services;

use ArtflowStudio\StarterKit\Services\AuthService as BaseAuthService;
use Illuminate\Database\Eloquent\Model;

class AuthService extends BaseAuthService
{
    public static function redirectAfterLogin(Model $user, $request = null): string
    {
        // Premium users
        if ($user->subscription_status === 'premium') {
            return '/premium/dashboard';
        }
        
        // Fall back to base logic (Spatie roles, etc.)
        return parent::redirectAfterLogin($user, $request);
    }
}
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

php artisan vendor:publish --tag=starterkit-auth-layouts    # Auth views (14 layouts)
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
<!-- resources/views/admin/dashboard.blade.php -->
@extends('starterkit::layouts.admin.sidebar')

@section('content')
    <div class="container-fluid">
        <h1>Admin Dashboard</h1>
        <!-- Your admin content -->
    </div>
@endsection
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

## 🎨 Available Layouts

### Authentication Layouts (14 Options)

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
| **base** | Minimal HTML | Base layout |

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

## 🧪 Testing Authentication

### Test Registration & Role-Based Redirect

```bash
# Start server
php artisan serve

# Visit registration page
http://localhost:8000/register

# Register a new user - should redirect to /dashboard
```

### Test Role-Based Login

```php
// Create test users with roles
php artisan tinker

use App\Models\User;
use Spatie\Permission\Models\Role;

// Create roles
Role::create(['name' => 'admin']);
Role::create(['name' => 'moderator']);

// Create admin user
$admin = User::factory()->create(['email' => 'admin@test.com']);
$admin->assignRole('admin');

// Create moderator user
$mod = User::factory()->create(['email' => 'mod@test.com']);
$mod->assignRole('moderator');
```

Then login:
- `admin@test.com` → redirects to `/admin/dashboard`
- `mod@test.com` → redirects to `/moderator/dashboard`
- Other users → redirects to `/dashboard`

---

## ❓ FAQ

### Q: Do I need npm/build step?
**A:** No! All assets are pre-compiled. Just run `php artisan starterkit:install`.

### Q: Can I customize the AuthService?
**A:** Yes! Run `php artisan starterkit:install --publish-auth-service` to get your own editable copy.

### Q: How do I use with Spatie roles?
**A:** AuthService automatically detects Spatie Laravel Permission. Just assign roles to users and the redirects work automatically.

### Q: Can I change layouts dynamically?
**A:** Yes! Update `STARTERKIT_AUTH_LAYOUT` in `.env` and refresh.

### Q: What if I don't use roles?
**A:** All users redirect to `/dashboard` by default. You can customize in AuthService.

### Q: Are the responses extensible?
**A:** Yes! All responses are in `vendor/artflow-studio/starterkit/src/Http/Responses/`. Each one can be customized.

---

## 🚨 Troubleshooting

### Issue: Still redirecting to `/home`

**Solution:**
```bash
php artisan config:clear
php artisan cache:clear  
php artisan route:clear
```

### Issue: Role redirects not working

**Checklist:**
1. Is Spatie installed? `composer show spatie/laravel-permission`
2. Did you run migrations? `php artisan migrate`
3. Does user have role? `User::find(1)->getRoleNames()`
4. Do routes exist? `php artisan route:list --path=admin`

### Issue: "Class not found" errors

**Solution:**
```bash
composer dump-autoload
php artisan clear-compiled
php artisan config:clear
php artisan cache:clear
```

### Issue: Response not binding

**Verify binding:**
```bash
php artisan tinker --execute="dd(app(Laravel\Fortify\Contracts\LoginResponse::class));"
```

Should output: `ArtflowStudio\StarterKit\Http\Responses\LoginResponse`

---

## 📚 Additional Resources

- **Fortify Documentation:** https://laravel.com/docs/fortify
- **Spatie Permission:** https://spatie.be/docs/laravel-permission/
- **Bootstrap Documentation:** https://getbootstrap.com/docs/5.3/
- **Package Repository:** https://github.com/artflow-studio/starterkit

---

## 📝 Summary

| Feature | Status | Details |
|---------|--------|---------|
| **Fortify Response Contracts** | ✅ 20/20 | All contracts implemented |
| **Role-Based Redirects** | ✅ Built-in | Spatie automatic detection |
| **AuthService** | ✅ Available | In package, publishable |
| **Auth Layouts** | ✅ 14 layouts | Ready to use |
| **Admin Layouts** | ✅ 5 layouts | Pre-built |
| **Dark Mode** | ✅ Native | Bootstrap native |
| **Pre-Built Assets** | ✅ Yes | No npm/build needed |
| **One-Command Install** | ✅ Yes | Fully automated |

---

## 📄 License

This package is open-sourced software licensed under the [MIT license](LICENSE.md).

---

## 🤝 Contributing

Contributions are welcome! Please feel free to submit pull requests.

---

## 📧 Support

For issues, questions, or suggestions, please open an issue on GitHub or contact the maintainers.

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
