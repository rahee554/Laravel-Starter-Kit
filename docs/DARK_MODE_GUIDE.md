# Dark Mode Implementation Guide

## Overview

All three stylesheets (Auth, Admin, Landing) now support Bootstrap 5.3's native dark mode system using the `data-bs-theme` attribute. The implementation uses CSS custom properties that automatically switch based on the theme.

---

## How to Enable Dark Mode

### Method 1: HTML Attribute (Recommended)
Add the `data-bs-theme` attribute to the `<html>` tag:

```html
<!-- Light Mode (Default) -->
<html lang="en" data-bs-theme="light">

<!-- Dark Mode -->
<html lang="en" data-bs-theme="dark">
```

### Method 2: JavaScript Toggle
Create a dark mode toggle button:

```html
<button id="theme-toggle" class="btn btn-secondary">
    <i class="icon-moon"></i> Toggle Dark Mode
</button>

<script>
document.getElementById('theme-toggle').addEventListener('click', function() {
    const html = document.documentElement;
    const currentTheme = html.getAttribute('data-bs-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    
    html.setAttribute('data-bs-theme', newTheme);
    localStorage.setItem('theme', newTheme);
});

// Load saved theme on page load
document.addEventListener('DOMContentLoaded', function() {
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-bs-theme', savedTheme);
});
</script>
```

### Method 3: System Preference Detection
Auto-detect user's system preference:

```javascript
// Detect system preference
if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    document.documentElement.setAttribute('data-bs-theme', 'dark');
} else {
    document.documentElement.setAttribute('data-bs-theme', 'light');
}

// Listen for system preference changes
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
    const newTheme = event.matches ? 'dark' : 'light';
    document.documentElement.setAttribute('data-bs-theme', newTheme);
});
```

---

## CSS Custom Properties

### Auth System Variables

#### Light Mode
```css
:root, [data-bs-theme="light"] {
    --auth-primary: #00aaff;
    --auth-bg: #ffffff;
    --auth-text: #1e293b;
    --auth-border: #e2e8f0;
    --auth-input-bg: #ffffff;
    --auth-input-border: #e2e8f0;
    --auth-input-text: #1e293b;
    --auth-placeholder: #94a3b8;
    --auth-card-bg: #ffffff;
    --auth-shadow: rgba(0, 0, 0, 0.1);
}
```

#### Dark Mode
```css
[data-bs-theme="dark"] {
    --auth-bg: #0f172a;
    --auth-text: #e2e8f0;
    --auth-border: #334155;
    --auth-input-bg: #1e293b;
    --auth-input-border: #334155;
    --auth-input-text: #e2e8f0;
    --auth-placeholder: #64748b;
    --auth-card-bg: #1e293b;
    --auth-shadow: rgba(0, 0, 0, 0.3);
}
```

### Admin System Variables

#### Light Mode
```css
:root, [data-bs-theme="light"] {
    --admin-primary: #00aaff;
    --admin-bg: #f8fafc;
    --admin-text: #1e293b;
    --admin-border: #e2e8f0;
    --admin-card-bg: #ffffff;
    --admin-sidebar-bg: #ffffff;
    --admin-header-bg: #ffffff;
    --admin-shadow: rgba(0, 0, 0, 0.1);
    --admin-hover-bg: #f1f5f9;
}
```

#### Dark Mode
```css
[data-bs-theme="dark"] {
    --admin-bg: #0f172a;
    --admin-text: #e2e8f0;
    --admin-border: #334155;
    --admin-card-bg: #1e293b;
    --admin-sidebar-bg: #1e293b;
    --admin-header-bg: #1e293b;
    --admin-shadow: rgba(0, 0, 0, 0.4);
    --admin-hover-bg: #334155;
}
```

### Landing Page Variables

#### Light Mode
```css
:root, [data-bs-theme="light"] {
    --landing-primary: #00aaff;
    --landing-bg: #ffffff;
    --landing-text: #1e293b;
    --landing-border: #e2e8f0;
    --landing-card-bg: #ffffff;
    --landing-section-bg: #f8fafc;
    --landing-shadow: rgba(0, 0, 0, 0.1);
}
```

#### Dark Mode
```css
[data-bs-theme="dark"] {
    --landing-bg: #0f172a;
    --landing-text: #e2e8f0;
    --landing-border: #334155;
    --landing-card-bg: #1e293b;
    --landing-section-bg: #1e293b;
    --landing-shadow: rgba(0, 0, 0, 0.4);
}
```

---

## Component Examples

### Auth Forms (Dark Mode Compatible)

```html
<div class="auth-card">
    <div class="auth-header">
        <h1>Welcome Back</h1>
        <p>Sign in to your account</p>
    </div>
    
    <form>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" placeholder="Enter email">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" placeholder="Enter password">
        </div>
        
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember">
            <label class="form-check-label" for="remember">Remember me</label>
        </div>
        
        <button type="submit" class="btn btn-primary w-100">Sign In</button>
    </form>
</div>
```

All form controls automatically adapt to dark mode!

### Admin Dashboard (Dark Mode Compatible)

```html
<div class="admin-shell" data-bs-theme="dark">
    <aside class="admin-sidebar">
        <nav class="admin-nav">
            <a href="#" class="admin-nav-item active">Dashboard</a>
            <a href="#" class="admin-nav-item">Users</a>
        </nav>
    </aside>
    
    <main class="admin-main">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Statistics</h5>
                <p class="card-text">Your content here</p>
            </div>
        </div>
    </main>
</div>
```

### Landing Page (Dark Mode Compatible)

```html
<section class="hero">
    <div class="container">
        <h1>Build Amazing <span class="text-gradient">Products</span></h1>
        <p class="lead">Create stunning applications</p>
        <button class="btn btn-primary btn-lg">Get Started</button>
    </div>
</section>
```

---

## Advanced Dark Mode Toggle Component

### Complete Toggle Button with Icons

```html
<button id="theme-toggle" class="btn btn-outline-secondary" aria-label="Toggle theme">
    <span class="theme-icon-light">🌙</span>
    <span class="theme-icon-dark">☀️</span>
</button>

<style>
[data-bs-theme="light"] .theme-icon-dark,
[data-bs-theme="dark"] .theme-icon-light {
    display: none;
}
</style>

<script>
const themeToggle = document.getElementById('theme-toggle');
const html = document.documentElement;

// Initialize theme from localStorage or system preference
function initTheme() {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        html.setAttribute('data-bs-theme', savedTheme);
    } else {
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        html.setAttribute('data-bs-theme', prefersDark ? 'dark' : 'light');
    }
}

// Toggle theme
function toggleTheme() {
    const currentTheme = html.getAttribute('data-bs-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    html.setAttribute('data-bs-theme', newTheme);
    localStorage.setItem('theme', newTheme);
}

// Event listeners
themeToggle.addEventListener('click', toggleTheme);
window.addEventListener('DOMContentLoaded', initTheme);

// Listen for system preference changes
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
    if (!localStorage.getItem('theme')) {
        html.setAttribute('data-bs-theme', e.matches ? 'dark' : 'light');
    }
});
</script>
```

---

## Form Controls in Dark Mode

### Before (Bootstrap Default)
Bootstrap's default form controls might not match your custom design in dark mode.

### After (Custom Override)
Our implementation **completely overrides** Bootstrap form controls with `!important` to maintain consistent styling in both light and dark modes:

```scss
.form-control {
    background: var(--auth-input-bg) !important;
    border-color: var(--auth-input-border) !important;
    color: var(--auth-input-text) !important;
    
    &:focus {
        border-color: var(--auth-primary) !important;
        box-shadow: 0 0 0 0.25rem rgba(0, 170, 255, 0.1) !important;
    }
}
```

This ensures:
- ✅ Custom styling always takes precedence over Bootstrap
- ✅ Consistent appearance in light and dark modes
- ✅ No style conflicts
- ✅ Proper placeholder colors
- ✅ Correct focus states

---

## Best Practices

### 1. Always Use CSS Variables
```css
/* Good */
.custom-component {
    background: var(--auth-card-bg);
    color: var(--auth-text);
    border: 1px solid var(--auth-border);
}

/* Bad - hardcoded colors won't work in dark mode */
.custom-component {
    background: #ffffff;
    color: #1e293b;
}
```

### 2. Test Both Modes
Always test your components in both light and dark modes:

```javascript
// Quick test toggle
document.documentElement.setAttribute('data-bs-theme', 'dark');
// Check your component
document.documentElement.setAttribute('data-bs-theme', 'light');
```

### 3. Respect User Preference
Save the user's choice and respect system preferences:

```javascript
// Save user preference
localStorage.setItem('theme', 'dark');

// Check if user has a saved preference
const hasPreference = localStorage.getItem('theme') !== null;
```

### 4. Smooth Transitions
Add transitions for theme switching:

```css
body {
    transition: background-color 0.3s ease, color 0.3s ease;
}

.auth-card, .card {
    transition: background-color 0.3s ease, border-color 0.3s ease;
}
```

---

## Troubleshooting

### Issue: Dark mode not applying
**Solution:** Check that `data-bs-theme="dark"` is on the `<html>` element:
```javascript
console.log(document.documentElement.getAttribute('data-bs-theme'));
```

### Issue: Custom colors not working in dark mode
**Solution:** Make sure you're using CSS variables, not hardcoded colors:
```css
/* Use this */
color: var(--auth-text);

/* Not this */
color: #1e293b;
```

### Issue: Form controls look wrong
**Solution:** Our custom overrides use `!important` to ensure consistency. If you see Bootstrap's default dark mode styles, rebuild:
```bash
npm run build
```

### Issue: Flash of wrong theme on page load
**Solution:** Add this inline script in `<head>` before any CSS:
```html
<script>
(function() {
    const theme = localStorage.getItem('theme') || 
                 (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    document.documentElement.setAttribute('data-bs-theme', theme);
})();
</script>
```

---

## Laravel Blade Integration

### Create a Theme Toggle Component

`resources/views/components/theme-toggle.blade.php`:
```blade
<button id="theme-toggle" class="btn btn-outline-secondary" title="Toggle theme">
    <span class="theme-icon-light">🌙</span>
    <span class="theme-icon-dark">☀️</span>
</button>

@push('scripts')
<script>
document.getElementById('theme-toggle').addEventListener('click', function() {
    const html = document.documentElement;
    const theme = html.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';
    html.setAttribute('data-bs-theme', theme);
    localStorage.setItem('theme', theme);
});

// Initialize on load
const savedTheme = localStorage.getItem('theme') || 
    (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
document.documentElement.setAttribute('data-bs-theme', savedTheme);
</script>
@endpush
```

### Use in Layout
```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>App</title>
    @vite(['resources/css/auth.scss'])
</head>
<body>
    <x-theme-toggle />
    
    @yield('content')
    
    @stack('scripts')
</body>
</html>
```

---

## Summary

✅ **Bootstrap-first approach** - All custom styles extend Bootstrap  
✅ **Native dark mode** - Uses Bootstrap's `data-bs-theme` system  
✅ **CSS variables** - Automatic switching between light/dark  
✅ **Form overrides** - Custom inputs maintain design in both modes  
✅ **Zero conflicts** - `!important` ensures custom styles take precedence  
✅ **Smooth transitions** - Animated theme switching  
✅ **Local storage** - User preference persistence  
✅ **System detection** - Auto-detect user's OS preference  

**Toggle dark mode:** Simply add `data-bs-theme="dark"` to `<html>` element!

Last Updated: November 18, 2025
