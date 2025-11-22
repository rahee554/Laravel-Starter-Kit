<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @include('starterkit::components.admin-assets')
</head>
<body>
    <!-- Admin Layout: Top Navigation -->
    <div class="admin-layout-topnav">
        <!-- Top Navigation Bar -->
        <header class="admin-header">
            <div class="header-container">
                <div class="header-logo">
                    <div class="logo-icon">{{ substr(config('app.name', 'L'), 0, 1) }}</div>
                    <span class="logo-text">{{ config('app.name', 'Laravel') }}</span>
                </div>

                <nav class="header-nav">
                    @yield('header-nav')
                </nav>

                <div class="header-actions">
                    @yield('header-actions')
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="admin-main-topnav">
            <!-- Breadcrumb/Secondary Nav -->
            @hasSection('secondary-nav')
                <div class="secondary-nav">
                    @yield('secondary-nav')
                </div>
            @endif

            <!-- Page Container -->
            <div class="admin-content-topnav">
                <!-- Page Header -->
                @hasSection('page-header')
                    <div class="page-header-topnav">
                        @yield('page-header')
                    </div>
                @endif

                <!-- Page Content -->
                <div class="page-body">
                    @yield('content')
                </div>
            </div>
        </main>

        <!-- Footer (Optional) -->
        @hasSection('footer')
            <footer class="admin-footer">
                @yield('footer')
            </footer>
        @endif
    </div>
</body>
</html>
