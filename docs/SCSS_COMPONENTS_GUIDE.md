# SCSS Components & Classes Guide

## Table of Contents
1. [Overview](#overview)
2. [Auth System](#auth-system)
3. [Admin System](#admin-system)
4. [Landing Pages](#landing-pages)
5. [Bootstrap Integration](#bootstrap-integration)

---

## Overview

All stylesheets follow a **Bootstrap-First** approach:
1. Custom variables override Bootstrap defaults
2. Bootstrap is imported
3. Custom components extend Bootstrap (not replace)

### File Structure
```
resources/css/
├── auth.scss          # Auth system entry point
│   ├── auth/_variables.scss
│   ├── auth/_reset.scss
│   ├── auth/_forms.scss
│   ├── auth/_buttons.scss
│   ├── auth/_components.scss
│   ├── auth/_layouts.scss
│   └── auth/_animations.scss
├── admin.scss         # Admin system entry point
│   ├── admin/_variables.scss
│   ├── admin/_base.scss
│   ├── admin/_shell.scss
│   ├── admin/_layouts.scss
│   ├── admin/_components.scss
│   └── admin/_responsive.scss
└── landing.scss       # Landing pages entry point
    ├── landing/_variables.scss
    ├── landing/_components.scss
    ├── landing/_sections.scss
    └── landing/_utilities.scss
```

---

## Auth System

### Available Layouts
1. **Centered/Clean** - Simple centered card
2. **Split** - Two-column with image
3. **Minimal** - Ultra-minimal design
4. **Glass** - Glassmorphism effect
5. **Particles** - Animated particles.js background
6. **Hero** - Full-width hero section
7. **Modern** - Modern gradient design
8. **3D** - 3D transform effects
9. **Premium Dark** - Dark premium theme
10. **Gradient Flow** - Animated gradient background

### Form Components

#### Basic Form (Extends Bootstrap)
```html
<form>
    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="email" placeholder="Enter your email">
    </div>
    
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Enter your password">
    </div>
    
    <button type="submit" class="btn btn-primary w-100">Sign In</button>
</form>
```

#### Checkbox (Custom Bootstrap Extension)
```html
<div class="form-check">
    <input class="form-check-input" type="checkbox" id="remember" />
    <label class="form-check-label" for="remember">
        Remember me
    </label>
</div>
```

#### Remember Me + Forgot Password Row
```html
<div class="form-group-row">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="remember" />
        <label class="form-check-label" for="remember">Remember me</label>
    </div>
    <a href="/forgot-password" class="btn btn-link">Forgot Password?</a>
</div>
```

### Button Variants (Extends Bootstrap)

```html
<!-- Primary Button with Gradient -->
<button class="btn btn-primary">Sign In</button>

<!-- Secondary Button -->
<button class="btn btn-secondary">Cancel</button>

<!-- Outline Button -->
<button class="btn btn-outline-primary">Learn More</button>

<!-- Link Button -->
<a href="#" class="btn btn-link">Forgot Password?</a>

<!-- Full Width Button -->
<button class="btn btn-primary w-100">Continue</button>
```

### Alert Messages (Bootstrap)
```html
<!-- Error Alert -->
<div class="alert alert-danger" role="alert">
    <ul>
        <li>Email is required</li>
        <li>Password must be at least 8 characters</li>
    </ul>
</div>

<!-- Success Alert -->
<div class="alert alert-success" role="alert">
    Your account has been created successfully!
</div>

<!-- Info Alert -->
<div class="alert alert-info" role="alert">
    Please verify your email address.
</div>
```

### Auth Card Structure
```html
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1>Welcome Back</h1>
            <p>Sign in to your account</p>
        </div>
        
        <!-- Form goes here -->
        
        <div class="auth-links">
            <p>Don't have an account? <a href="/register">Sign up</a></p>
        </div>
    </div>
</div>
```

### Available CSS Classes

| Class | Description |
|-------|-------------|
| `.auth-container` | Main wrapper for auth pages |
| `.auth-card` | Card container for auth forms |
| `.auth-header` | Header section with title and subtitle |
| `.auth-links` | Links section (Sign up, etc.) |
| `.form-check` | Custom checkbox/radio wrapper |
| `.form-check-input` | Custom styled input |
| `.form-check-label` | Label for checkbox/radio |
| `.form-group-row` | Row layout for remember me + forgot password |
| `.btn-primary` | Primary button with gradient |
| `.btn-secondary` | Secondary button |
| `.btn-outline-primary` | Outline button |
| `.btn-link` | Link-style button |

---

## Admin System

### Available Layouts
1. **Sidebar** - Traditional sidebar navigation
2. **TopNav** - Top navigation bar
3. **Minimal** - Minimalist admin design
4. **Board** - Kanban board style

### Admin Shell Structure
```html
<div class="admin-shell">
    <aside class="admin-sidebar">
        <div class="admin-brand">
            <h2>Admin</h2>
        </div>
        <nav class="admin-nav">
            <a href="#" class="admin-nav-item active">
                <i class="icon"></i>
                Dashboard
            </a>
            <a href="#" class="admin-nav-item">
                <i class="icon"></i>
                Users
            </a>
        </nav>
    </aside>
    
    <main class="admin-main">
        <header class="admin-header">
            <h1>Dashboard</h1>
            <div class="admin-actions">
                <!-- Actions here -->
            </div>
        </header>
        
        <div class="admin-content">
            <!-- Page content -->
        </div>
    </main>
</div>
```

### Cards (Extends Bootstrap)
```html
<!-- Basic Card -->
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Card Title</h5>
        <p class="card-text">Card content goes here.</p>
    </div>
</div>

<!-- Card with Header and Footer -->
<div class="card">
    <div class="card-header">
        Featured
    </div>
    <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">Supporting text below the title.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
    <div class="card-footer text-muted">
        2 days ago
    </div>
</div>
```

### Tables (Extends Bootstrap)
```html
<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>John Doe</td>
            <td>john@example.com</td>
            <td><span class="badge bg-success">Active</span></td>
            <td>
                <button class="admin-icon-btn">
                    <i class="icon-edit"></i>
                </button>
            </td>
        </tr>
    </tbody>
</table>
```

### Custom Components

#### Admin Chip
```html
<button class="admin-chip">
    <i class="icon-plus"></i> Add New
</button>
```

#### Icon Button
```html
<button class="admin-icon-btn">
    <i class="icon-settings"></i>
</button>
```

#### Avatar
```html
<div class="admin-avatar">JD</div>
```

### Badges (Extends Bootstrap)
```html
<span class="badge bg-primary">Primary</span>
<span class="badge bg-secondary">Secondary</span>
<span class="badge bg-success">Success</span>
<span class="badge bg-danger">Danger</span>
<span class="badge bg-warning">Warning</span>
<span class="badge bg-info">Info</span>
```

### Available CSS Classes

| Class | Description |
|-------|-------------|
| `.admin-shell` | Main admin wrapper |
| `.admin-sidebar` | Sidebar navigation |
| `.admin-brand` | Brand/logo section |
| `.admin-nav` | Navigation container |
| `.admin-nav-item` | Navigation link |
| `.admin-main` | Main content area |
| `.admin-header` | Page header |
| `.admin-content` | Content wrapper |
| `.admin-chip` | Action chip/button |
| `.admin-icon-btn` | Icon-only button |
| `.admin-avatar` | User avatar |

---

## Landing Pages

### Hero Section
```html
<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1>
                        Build Amazing
                        <span class="text-gradient">Products</span>
                    </h1>
                    <p class="lead">
                        Create stunning web applications with our powerful toolkit.
                    </p>
                    <div class="hero-buttons">
                        <a href="#" class="btn btn-primary btn-lg">Get Started</a>
                        <a href="#" class="btn btn-outline-primary btn-lg">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image">
                    <img src="hero.jpg" alt="Hero Image" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>
</section>
```

### Features Section
```html
<section class="features-section">
    <div class="container">
        <div class="section-header">
            <h2>Amazing Features</h2>
            <p>Everything you need to build modern applications</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="icon-fast"></i>
                    </div>
                    <h3>Lightning Fast</h3>
                    <p>Optimized for speed and performance.</p>
                </div>
            </div>
            <!-- More feature cards -->
        </div>
    </div>
</section>
```

### Pricing Cards
```html
<section class="pricing-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="pricing-card">
                    <div class="pricing-title">Starter</div>
                    <div class="pricing-price">
                        <span class="currency">$</span>9
                        <span class="period">/month</span>
                    </div>
                    <p class="pricing-description">Perfect for individuals</p>
                    <ul class="pricing-features">
                        <li>5 Projects</li>
                        <li>10GB Storage</li>
                        <li>Email Support</li>
                    </ul>
                    <button class="btn btn-outline-primary w-100">Choose Plan</button>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="pricing-card featured">
                    <span class="pricing-badge">Popular</span>
                    <div class="pricing-title">Pro</div>
                    <div class="pricing-price">
                        <span class="currency">$</span>29
                        <span class="period">/month</span>
                    </div>
                    <p class="pricing-description">For professionals</p>
                    <ul class="pricing-features">
                        <li>Unlimited Projects</li>
                        <li>100GB Storage</li>
                        <li>Priority Support</li>
                        <li>Advanced Analytics</li>
                    </ul>
                    <button class="btn btn-primary w-100">Choose Plan</button>
                </div>
            </div>
        </div>
    </div>
</section>
```

### Testimonial Cards
```html
<div class="testimonial-card">
    <div class="testimonial-stars">★★★★★</div>
    <p class="testimonial-text">
        "This product has completely transformed how we work. Highly recommended!"
    </p>
    <div class="testimonial-author">
        <div class="author-avatar">JD</div>
        <div class="author-info">
            <h4>John Doe</h4>
            <p>CEO, Company Inc</p>
        </div>
    </div>
</div>
```

### CTA Section
```html
<section class="cta-section">
    <div class="container">
        <h2>Ready to Get Started?</h2>
        <p>Join thousands of satisfied customers today.</p>
        <a href="#" class="btn btn-light btn-lg">Start Free Trial</a>
    </div>
</section>
```

### Stats Section
```html
<section class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">10K+</div>
                    <div class="stats-label">Active Users</div>
                </div>
            </div>
            <!-- More stats -->
        </div>
    </div>
</section>
```

### Navbar (Extends Bootstrap)
```html
<nav class="navbar navbar-expand-lg landing-navbar">
    <div class="container">
        <a class="navbar-brand" href="/">Brand</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#features">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pricing">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
            </ul>
            <button class="btn btn-primary ms-3">Get Started</button>
        </div>
    </div>
</nav>
```

### Available CSS Classes

| Class | Description |
|-------|-------------|
| `.hero` | Hero section wrapper |
| `.hero-content` | Hero text content |
| `.hero-image` | Hero image container |
| `.hero-buttons` | Button group in hero |
| `.text-gradient` | Gradient text effect |
| `.features-section` | Features section wrapper |
| `.section-header` | Section title and description |
| `.feature-card` | Feature card component |
| `.feature-icon` | Icon container for features |
| `.pricing-section` | Pricing section wrapper |
| `.pricing-card` | Pricing card component |
| `.pricing-card.featured` | Featured pricing card |
| `.pricing-badge` | "Popular" badge |
| `.pricing-title` | Plan name |
| `.pricing-price` | Price display |
| `.pricing-features` | Feature list |
| `.testimonial-card` | Testimonial component |
| `.testimonial-stars` | Star rating |
| `.testimonial-text` | Quote text |
| `.testimonial-author` | Author info |
| `.cta-section` | Call-to-action section |
| `.stats-section` | Statistics section |
| `.stats-card` | Individual stat |
| `.stats-number` | Stat number |
| `.stats-label` | Stat description |
| `.landing-navbar` | Landing page navbar |
| `.landing-footer` | Landing page footer |

---

## Bootstrap Integration

### How Components Extend Bootstrap

All custom components are built **on top of** Bootstrap 5.3.8, not replacing it.

#### Example: Custom Button extending Bootstrap
```scss
// Bootstrap provides base .btn class
// We enhance it with custom styles

.btn-primary {
    // Bootstrap base styles are preserved
    // We add gradient and shadows on top
    background: linear-gradient(135deg, #00aaff 0%, #0088cc 100%);
    box-shadow: 0 2px 8px rgba(0, 170, 255, 0.15);
    
    &:hover {
        background: linear-gradient(135deg, #0099ee 0%, #007acc 100%);
        transform: translateY(-2px);
    }
}
```

#### Example: Custom Form Control extending Bootstrap
```scss
// Bootstrap provides .form-control
// We enhance border, focus states, and transitions

.form-control {
    border: 1px solid #e2e8f0;
    
    &:focus {
        border-color: #00aaff;
        box-shadow: 0 0 0 0.25rem rgba(0, 170, 255, 0.1);
    }
}
```

### Using Bootstrap Grid System

All layouts use Bootstrap's grid system:

```html
<div class="container">
    <div class="row">
        <div class="col-md-6">Column 1</div>
        <div class="col-md-6">Column 2</div>
    </div>
</div>

<!-- Responsive columns -->
<div class="row">
    <div class="col-12 col-md-6 col-lg-4">Column</div>
    <div class="col-12 col-md-6 col-lg-4">Column</div>
    <div class="col-12 col-md-6 col-lg-4">Column</div>
</div>
```

### Bootstrap Utilities Available

All Bootstrap 5.3.8 utility classes work:

```html
<!-- Spacing -->
<div class="mt-3 mb-4 p-5">Content</div>

<!-- Display -->
<div class="d-flex justify-content-between align-items-center">Content</div>

<!-- Typography -->
<h1 class="text-center fw-bold">Heading</h1>
<p class="text-muted">Muted text</p>

<!-- Colors -->
<div class="bg-primary text-white">Primary background</div>
<div class="bg-light text-dark">Light background</div>

<!-- Borders -->
<div class="border border-2 rounded">Bordered</div>

<!-- Shadows -->
<div class="shadow-sm">Shadow</div>
```

### Responsive Breakpoints

Bootstrap breakpoints are used throughout:

| Breakpoint | Class Infix | Dimensions |
|------------|-------------|------------|
| X-Small | None | <576px |
| Small | `sm` | ≥576px |
| Medium | `md` | ≥768px |
| Large | `lg` | ≥992px |
| Extra Large | `xl` | ≥1200px |
| Extra Extra Large | `xxl` | ≥1400px |

---

## Animation Classes

### Fade In Animations
```html
<div class="animate-fadeInUp">Fades in from bottom</div>
<div class="animate-fadeIn">Fades in</div>
<div class="animate-scaleIn">Scales in</div>
```

### Slide Animations
```html
<div class="animate-slideInLeft">Slides from left</div>
<div class="animate-slideInRight">Slides from right</div>
```

### Continuous Animations
```html
<div class="animate-float">Floats up and down</div>
<div class="animate-pulse">Pulses</div>
```

### Stagger Delays
```html
<div class="animate-fadeInUp animate-delay-100">Item 1</div>
<div class="animate-fadeInUp animate-delay-200">Item 2</div>
<div class="animate-fadeInUp animate-delay-300">Item 3</div>
```

---

## Best Practices

1. **Always use Bootstrap classes first**
   ```html
   <!-- Good -->
   <button class="btn btn-primary">Click Me</button>
   
   <!-- Bad - Don't create custom button from scratch -->
   <button class="custom-button">Click Me</button>
   ```

2. **Use Bootstrap grid system**
   ```html
   <!-- Good -->
   <div class="container">
       <div class="row">
           <div class="col-md-6">Content</div>
       </div>
   </div>
   ```

3. **Extend, don't replace**
   ```scss
   // Good - Extending Bootstrap
   .btn-primary {
       // Add custom styles on top
       box-shadow: 0 4px 12px rgba(0, 170, 255, 0.3);
   }
   
   // Bad - Replacing Bootstrap
   .btn {
       // Completely redefining button
   }
   ```

4. **Use Bootstrap utilities**
   ```html
   <!-- Good -->
   <div class="d-flex justify-content-between mb-3">Content</div>
   
   <!-- Bad - Custom CSS for spacing/flexbox -->
   <div class="custom-flex-row">Content</div>
   ```

5. **Leverage Bootstrap components**
   - Cards, Modals, Alerts, Badges
   - Navigation, Dropdowns, Tooltips
   - Form controls and validation
   - All documented at: https://getbootstrap.com/docs/5.3/

---

## Compilation

Build SCSS files:
```bash
npm run build        # Production build
npm run dev          # Development build with watch
```

Output files:
- `public/build/assets/auth-*.css` - Auth styles
- `public/build/assets/admin-*.css` - Admin styles  
- `public/build/assets/app-*.css` - Landing styles

---

## Quick Reference

### Most Used Classes

**Forms:**
- `.form-label` - Form label
- `.form-control` - Text input
- `.form-select` - Dropdown
- `.form-check` - Checkbox/radio wrapper
- `.form-check-input` - Checkbox/radio input
- `.form-check-label` - Checkbox/radio label

**Buttons:**
- `.btn` - Base button
- `.btn-primary` - Primary action
- `.btn-secondary` - Secondary action
- `.btn-outline-primary` - Outlined button
- `.btn-link` - Link-style button
- `.btn-lg` / `.btn-sm` - Size variants
- `.w-100` - Full width

**Layout:**
- `.container` - Fixed width container
- `.container-fluid` - Full width container
- `.row` - Grid row
- `.col-*` - Grid columns
- `.d-flex` - Flexbox container
- `.justify-content-*` - Horizontal alignment
- `.align-items-*` - Vertical alignment

**Spacing:**
- `.m-*` / `.mt-*` / `.mb-*` / `.ms-*` / `.me-*` - Margins
- `.p-*` / `.pt-*` / `.pb-*` / `.ps-*` / `.pe-*` - Padding
- Sizes: 0, 1, 2, 3, 4, 5 (0rem to 3rem)

**Typography:**
- `.text-center` / `.text-start` / `.text-end`
- `.fw-bold` / `.fw-normal` / `.fw-light`
- `.fs-1` through `.fs-6` - Font sizes
- `.text-muted` / `.text-primary` / `.text-danger`

---

## Support

For issues or questions:
1. Check Bootstrap 5.3 docs: https://getbootstrap.com/docs/5.3/
2. Review this guide
3. Inspect element in browser to see applied classes
4. Check compiled CSS in `public/build/assets/`

Last Updated: November 18, 2025
