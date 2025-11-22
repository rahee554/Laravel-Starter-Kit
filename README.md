# AF Laravel Starter Kit

[![Latest Version](https://img.shields.io/badge/version-1.0.0-blue.svg)](https://github.com/artflow-studio/af-laravel-starter-kit)
[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.8-purple.svg)](https://getbootstrap.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE.md)

**Production-Ready Laravel Authentication & Admin Starter Kit**

> 18 Beautiful Pre-Built Layouts | Zero Build Required | Bootstrap 5.3.8 | Dark Mode Support | Laravel Fortify Integration

A complete, professionally designed Laravel package with **13 authentication layouts**, **5 admin dashboard layouts**, Bootstrap 5.3.8, native dark mode, and Laravel Fortify integration. **Pre-built assets mean zero npm/build step required after installation**.

---

## ✨ Features

- 🎨 **18 Total Layouts** - 13 authentication + 5 admin professionally designed layouts
- 🌙 **Dark Mode** - Native Bootstrap dark mode with smooth transitions  
- 📱 **Fully Responsive** - Mobile-first design, works on all devices
- 🚀 **Bootstrap 5.3.8** - Latest Bootstrap with custom form controls
- ⚡ **Pre-Built Assets** - No npm/build step required for installation!
- 🔐 **Laravel Fortify** - Complete authentication scaffolding integrated
- 🎭 **Animated Effects** - Particles, gradients, and smooth transitions (pure CSS)
- 🎛️ **Customizable** - Easy to modify colors, layouts, and components
- 📚 **Complete Documentation** - Comprehensive docs and guides included
- 🧹 **Clean Installation** - Optional customizations don't publish by default

---

## 📦 Installation

### 1. Install via Composer

```bash
composer require artflow-studio/starterkit
```

### 2. Publish Assets & Views

```bash
php artisan starterkit:install
```

This command publishes:
- ✅ Pre-built assets to `public/vendor/artflow-studio/starterkit/assets/`
- ✅ Views to `resources/views/vendor/starterkit/`
- ✅ Configuration to `config/starterkit.php`
- ✅ Routes for layout testing to `routes/test-layouts.php`
- ✅ Laravel Fortify (if not already installed)

**No npm build required!** Assets are pre-compiled and production-ready.

### 3. Setup Database

```bash
# Configure .env with your database connection
php artisan migrate
```

### 4. Start Using

Visit `/login` to see your authentication pages with the default layout!

Visit `/test/layouts` (after install) to preview all 18 available layouts.

---

## 🎯 Quick Usage

### Use an Authentication Layout

```blade
<!-- File: resources/views/auth/login.blade.php -->
@extends('starterkit::layouts.auth.login')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
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

### Use an Admin Layout

```blade
<!-- File: resources/views/dashboard.blade.php -->
@extends('starterkit::layouts.admin.sidebar')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="h2">1,234</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
```

---

## 🎨 Available Layouts

### Authentication Layouts (13 Options)

| Layout | Best For | Key Features |
|--------|----------|----------|
| **particles** | Modern feel | Animated particles background with connecting lines |
| **centered** | Classic login | Simple centered form box |
| **split** | Brand showcase | Side-by-side layout with content |
| **glass** | Contemporary | Glassmorphism effect with backdrop blur |
| **hero** | Marketing | Large hero section with call-to-action |
| **modern** | Professional | Contemporary design patterns |
| **3d** | Creative | 3D effects and transforms |
| **premium-dark** | Luxury | Dark theme with premium styling |
| **gradient-flow** | Dynamic | Animated gradient backgrounds |
| **minimal** | Clean | Ultra-simple, distraction-free design |
| **clean** | Business | Professional business-focused design |
| **hero-grid** | Modern | Grid-based responsive layout |
| **sidebar** | Navigation | Sidebar-style authentication |

### Admin Layouts (5 Options)

| Layout | Best For | Key Features |
|--------|----------|----------|
| **sidebar** | Dashboards | Collapsible sidebar, responsive, full-featured |
| **topnav** | Web apps | Horizontal navigation bar with dropdowns |
| **minimal** | Analytics | Content-focused, minimal chrome |
| **neo** | Modern | Glassmorphic design, contemporary feel |
| **classic** | Enterprise | Traditional admin panel design |

### Preview All Layouts

Test all layouts during development:

```bash
# After installation, visit in browser:
http://localhost:8000/test/layouts
```

This page displays all 18 layouts with live previews.

---

## 🌙 Dark Mode

Dark mode is fully supported via Bootstrap's native system. All layouts automatically support dark mode:

```blade
<!-- Light theme (default) -->
<html data-bs-theme="light">

<!-- Dark theme -->
<html data-bs-theme="dark">
```

Users can switch themes programmatically:

```javascript
// Toggle dark mode
function toggleTheme() {
    const html = document.documentElement;
    const currentTheme = html.getAttribute('data-bs-theme') || 'light';
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    
    html.setAttribute('data-bs-theme', newTheme);
    localStorage.setItem('theme', newTheme);
}

// Load saved theme preference
window.addEventListener('load', () => {
    const saved = localStorage.getItem('theme');
    if (saved) {
        document.documentElement.setAttribute('data-bs-theme', saved);
    }
});
```

---

## 🛠️ Configuration

### Configure Default Layouts

Edit `config/starterkit.php`:

```php
return [
    // Default layouts
    'layouts' => [
        'auth' => env('STARTERKIT_AUTH_LAYOUT', 'particles'),
        'admin' => env('STARTERKIT_ADMIN_LAYOUT', 'sidebar'),
    ],

    // Dark mode settings
    'dark_mode' => [
        'enabled' => true,
        'default' => 'light',  // 'light' or 'dark'
    ],

    // Asset paths
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

Or use environment variables:

```env
STARTERKIT_AUTH_LAYOUT=glass
STARTERKIT_ADMIN_LAYOUT=topnav
STARTERKIT_DARK_MODE_ENABLED=true
STARTERKIT_DARK_MODE_DEFAULT=light
```

### Customize Colors & Styles

Publish views to customize:

```bash
php artisan vendor:publish --tag=starterkit-views
```

Edit files in `resources/views/vendor/starterkit/` to customize colors, layouts, and components.

---

## 📚 Documentation

All documentation is included in the `docs/` directory:

- **`START_HERE.md`** - Quick start and setup guide
- **`LAYOUTS_DOCUMENTATION.html`** - Interactive showcase of all 18 layouts
- **`DARK_MODE_GUIDE.md`** - Dark mode implementation details
- **`SCSS_COMPONENTS_GUIDE.md`** - CSS classes and styling reference
- **`FINAL_PROJECT_COMPLETION.md`** - Complete project overview and features

Publish documentation to your project:

```bash
php artisan vendor:publish --tag=starterkit-docs
# Published to: docs/starterkit/
```

Or open `docs/LAYOUTS_DOCUMENTATION.html` directly in a browser for interactive layout previews.

---

## 🔐 Fortify Customizations

The package includes optional custom authentication files for extending Laravel Fortify:

- **`CustomAuthMiddleware`** - Custom authentication middleware for route protection
- **`CustomAuthRedirectController`** - Custom redirect logic after login/register/logout
- **`AuthenticationListener`** - Event listeners for authentication events (login, register, logout)

### These are NOT published by default

Customizations are only published when explicitly requested:

```bash
php artisan vendor:publish --tag=starterkit-fortify-customizations
```

This publishes to:
- `app/Http/Middleware/CustomAuthMiddleware.php`
- `app/Http/Controllers/Auth/CustomAuthRedirectController.php`
- `app/Listeners/AuthenticationListener.php`

### Example Usage

```php
// In routes/web.php
Route::middleware(['custom-auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Register listeners in app/Providers/EventServiceProvider.php
protected $listen = [
    Login::class => [
        AuthenticationListener::class,
    ],
    Registered::class => [
        AuthenticationListener::class,
    ],
    Logout::class => [
        AuthenticationListener::class,
    ],
];
```

---

## 📂 Package Structure

```
starterkit/
├── src/
│   ├── Console/
│   │   ├── InstallCommand.php        # Main installation command
│   │   ├── PublishCommand.php        # Publishing command
│   │   └── BuildPackageCommand.php   # Build/package command
│   └── StarterKitServiceProvider.php # Service provider
│
├── config/
│   └── starterkit.php                # Configuration file
│
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── auth/                 # 13 authentication layouts
│   │   │   └── admin/                # 5 admin layouts
│   │   └── components/               # Reusable Blade components
│   └── css/
│       ├── auth.scss                 # Authentication styles
│       ├── admin.scss                # Admin styles
│       └── (organized modular SCSS)
│
├── public/vendor/artflow-studio/starterkit/
│   └── assets/                       # Pre-built, production-ready CSS/JS
│       ├── auth.css
│       ├── auth.js
│       ├── admin.css
│       └── admin.js
│
├── docs/                             # Complete documentation
│   ├── START_HERE.md
│   ├── LAYOUTS_DOCUMENTATION.html
│   ├── DARK_MODE_GUIDE.md
│   ├── SCSS_COMPONENTS_GUIDE.md
│   └── FINAL_PROJECT_COMPLETION.md
│
├── database/
│   └── migrations/                   # Database migrations
│
├── app/
│   ├── Listeners/
│   │   └── AuthenticationListener.php (optional, not published by default)
│   └── Http/
│       ├── Middleware/
│       │   └── CustomAuthMiddleware.php (optional, not published by default)
│       └── Controllers/
│           └── CustomAuthRedirectController.php (optional, not published by default)
│
├── routes/
│   └── test-layouts.php              # Layout testing routes
│
├── composer.json                     # Package metadata
└── README.md                         # This file
```

---

## 📋 Available Commands

### Installation & Setup

```bash
# Install and publish assets
php artisan starterkit:install

# Install with specific layout
php artisan starterkit:install --layout=glass

# Force overwrite existing files
php artisan starterkit:install --force
```

### Publishing

```bash
# Publish specific components
php artisan vendor:publish --tag=starterkit-views
php artisan vendor:publish --tag=starterkit-assets
php artisan vendor:publish --tag=starterkit-config
php artisan vendor:publish --tag=starterkit-docs
php artisan vendor:publish --tag=starterkit-migrations

# Publish ONLY Fortify customizations (optional)
php artisan vendor:publish --tag=starterkit-fortify-customizations

# Publish everything with force
php artisan vendor:publish --force
```

### Package Building (Maintainers Only)

```bash
# Build and validate package for distribution
php artisan package:build

# This command:
# - Runs npm build for assets
# - Compiles and optimizes CSS/JS
# - Validates package structure
# - Generates summary report
```

---

## 🧪 Testing

### Manual Layout Testing

After installation, test all layouts:

```bash
# Start development server
php artisan serve

# Visit in browser
http://localhost:8000/test/layouts
```

This page displays all 18 layouts with live previews and switching options.

### Unit Tests

```bash
php artisan test
npm run test
```

---

## 🐛 Troubleshooting

### Assets Not Loading

```bash
# Clear cache
php artisan optimize:clear

# Reinstall
php artisan starterkit:install

# Verify assets exist
ls public/vendor/artflow-studio/starterkit/assets/
```

### Layouts Not Displaying

```bash
# Publish views
php artisan vendor:publish --tag=starterkit-views

# Verify views exist
ls resources/views/vendor/starterkit/layouts/
```

### Dark Mode Not Working

1. Check your layout includes `data-bs-theme` attribute:

```blade
<!DOCTYPE html>
<html data-bs-theme="light">
    <!-- content -->
</html>
```

2. Verify Bootstrap CSS is loaded
3. Check browser console for JavaScript errors

### Fortify Not Installed

The install command installs Fortify automatically. If issues persist:

```bash
php artisan fortify:install
php artisan migrate
php artisan starterkit:install
```

### File Permission Issues

```bash
# Fix permissions
chmod -R 755 storage bootstrap/cache
php artisan starterkit:install --force
```

---

## 🚀 Development

### Local Development Setup

```bash
# Clone repository
git clone https://github.com/artflow-studio/af-laravel-starter-kit.git
cd af-laravel-starter-kit

# Install dependencies
composer install
npm install

# Configure
cp .env.example .env
php artisan key:generate

# Database
php artisan migrate

# Development servers (in separate terminals)
php artisan serve        # Terminal 1: PHP server (localhost:8000)
npm run dev             # Terminal 2: Vite watch mode
```

### Build Commands

```bash
# Build assets for production
npm run build

# Build and package for distribution
php artisan package:build

# Run tests
php artisan test
npm run test
```

---

## ✅ What's Included

### Layouts
- ✅ 13 authentication layouts (login, register, reset, verify, 2FA variants)
- ✅ 5 admin panel layouts (sidebar, topnav, minimal, neo, classic)
- ✅ All responsive and mobile-optimized

### Assets
- ✅ Pre-built CSS (257 KB auth + 235 KB admin)
- ✅ Pre-built JavaScript (4 KB each)
- ✅ Bootstrap 5.3.8 integration
- ✅ Dark mode support
- ✅ Particle effects and animations

### Documentation
- ✅ Interactive HTML layout showcase
- ✅ Quick start guide
- ✅ CSS/SCSS components reference
- ✅ Dark mode implementation guide
- ✅ Fortify integration examples

### Database
- ✅ User table migrations
- ✅ Authentication tables setup

### Customization Files (Optional)
- ✅ Custom middleware for authentication
- ✅ Custom redirect controller
- ✅ Authentication event listeners

---

## 🔧 Requirements

- **PHP**: 8.2, 8.3+
- **Laravel**: 11.x
- **Bootstrap**: 5.3.8
- **Node.js**: 18+ (for development only)
- **NPM**: 9+ (for development only)
- **Composer**: 2.x

---

## 📄 License

MIT License - Free to use in your projects!

See LICENSE.md for complete license details.

---

## 🤝 Support & Contribution

### Getting Help

1. Check the `docs/` directory for comprehensive guides
2. Review `LAYOUTS_DOCUMENTATION.html` for layout examples
3. Visit `/test/layouts` route to preview all layouts
4. Check Laravel Fortify docs: https://laravel.com/docs/fortify
5. Check Bootstrap docs: https://getbootstrap.com/docs/

### Contributing

Contributions are welcome! Please:

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

---

## 📊 Project Information

**AF Laravel Starter Kit**
- **Latest Version**: 1.0.0
- **Laravel Support**: 11.x+
- **PHP Support**: 8.2+
- **Bootstrap Version**: 5.3.8
- **License**: MIT
- **Repository**: https://github.com/artflow-studio/af-laravel-starter-kit

---

## 🎯 Next Steps

After installation:

1. ✅ Visit `/test/layouts` to explore all available layouts
2. ✅ Publish views to customize: `php artisan vendor:publish --tag=starterkit-views`
3. ✅ Configure default layout in `.env` or `config/starterkit.php`
4. ✅ Read `docs/DARK_MODE_GUIDE.md` to implement dark mode
5. ✅ Customize colors in `resources/css/` if needed
6. ✅ (Optional) Publish Fortify customizations for advanced auth logic

---

**Ready to build amazing Laravel applications?** 

Start using **AF Laravel Starter Kit** today! 🚀

Made with ❤️ by Artflow Studio
