<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description')">
    <title>@yield('title', 'Laravel') - {{ config('app.name') }}</title>

    @include('starterkit::components.auth-assets')
</head>
<body>
<div class="auth-layout-modern">
    <div class="auth-container">
        <div class="auth-card">
            <!-- Logo & Branding Section -->
            <div class="auth-header">
                <div class="logo-placeholder">L</div>
                <h1>@yield('title', 'Sign In')</h1>
                <p>@yield('description', 'Welcome back')</p>
            </div>

            <!-- Alert Messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Oops!</strong> Please fix the following errors:
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Form Content -->
            @yield('content')

            <!-- Footer Links -->
            @hasSection('footer-links')
                <div class="auth-links">
                    @yield('footer-links')
                </div>
            @endif
        </div>
    </div>
</div>
</body>
</html>
