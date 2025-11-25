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
    <!-- Admin Layout: Sidebar Navigation -->
    <div class="admin-layout-sidebar">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    {{ substr(config('app.name', 'L'), 0, 1) }}
                </div>
                <h2>{{ config('app.name', 'Laravel') }}</h2>
            </div>

            <nav class="sidebar-nav">
                @hasSection('sidebar-nav')
                    @yield('sidebar-nav')
                @else
                    @include('starterkit::layouts.starterkit.admin.partials.nav')
                @endif
            </nav>

            <div class="sidebar-footer">
                @yield('sidebar-footer')
            </div>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <!-- Top Bar -->
            <div class="admin-topbar">
                <div class="topbar-left">
                    <button class="sidebar-toggle" id="sidebarToggle">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </button>
                    @hasSection('breadcrumb')
                        <div class="breadcrumb-nav">
                            @yield('breadcrumb')
                        </div>
                    @endif
                </div>

                <div class="topbar-right">
                    @yield('topbar-actions')
                </div>
            </div>

            <!-- Page Content -->
            <div class="admin-content">
                @hasSection('page-header')
                    <div class="page-header">
                        @yield('page-header')
                    </div>
                @endif

                <div class="page-body">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <script>
        // Simple sidebar toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.querySelector('.admin-layout-sidebar').classList.toggle('sidebar-collapsed');
        });
    </script>
</body>
</html>
