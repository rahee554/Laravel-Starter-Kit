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
    <!-- Admin Layout: Minimal (Full Width) -->
    <div class="admin-layout-minimal">
        <!-- Minimal Header -->
        <header class="admin-header-minimal">
            <div class="header-content">
                <div class="header-title">
                    <h1>@yield('title')</h1>
                </div>
                <div class="header-controls">
                    @yield('header-controls')
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="admin-main-minimal">
            <!-- Filters/Tools Bar (Optional) -->
            @hasSection('tools-bar')
                <div class="tools-bar">
                    @yield('tools-bar')
                </div>
            @endif

            <!-- Page Content -->
            <div class="admin-content-minimal">
                @yield('content')
            </div>
        </main>

        <!-- Footer (Optional) -->
        @hasSection('footer')
            <footer class="admin-footer-minimal">
                @yield('footer')
            </footer>
        @endif
    </div>
</body>
</html>
