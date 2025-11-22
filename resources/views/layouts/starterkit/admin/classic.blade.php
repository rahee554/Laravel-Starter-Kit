<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'StarterKit Admin') }} · @yield('header_title', 'Dashboard')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @include('starterkit::components.admin-assets')
</head>
<body class="admin-surface">
    <div class="admin-shell" data-layout="classic">
        <aside class="admin-shell__sidebar" id="adminShellSidebar">
            <div class="admin-brand">
                <div class="admin-brand__logo">{{ substr(config('app.name', 'L'), 0, 1) }}</div>
                <div class="admin-brand__meta">
                    <p class="admin-brand__eyebrow">Control Center</p>
                    <p class="admin-brand__title">{{ config('app.name', 'StarterKit') }}</p>
                </div>
                <button class="admin-shell__toggle" data-sidebar-toggle>
                    <span class="sr-only">Toggle sidebar</span>
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </button>
            </div>

            <div class="admin-shell__nav">
                @include('layouts.starterkit.admin.partials.nav')
            </div>

            <div class="admin-shell__sidebar-footer">
                <p class="admin-shell__sidebar-label">Status</p>
                <div class="admin-shell__status">
                    <div>
                        <span>Uptime</span>
                        <strong>99.9%</strong>
                    </div>
                    <div>
                        <span>Active Users</span>
                        <strong>1,284</strong>
                    </div>
                </div>
            </div>
        </aside>

        <div class="admin-shell__main">
            <header class="admin-shell__header">
                <div class="admin-shell__header-info">
                    <p class="eyebrow">Overview</p>
                    <div>
                        <h1>@yield('header_title', 'Dashboard')</h1>
                        <p>@yield('header_subtitle', 'Track growth, revenue, and system health in one glance.')</p>
                    </div>
                </div>

                @php
                    $userName = optional(auth()->user())->name ?? config('app.name', 'SK');
                @endphp
                <div class="admin-shell__header-actions">
                    <form class="admin-shell__search" role="search">
                        <span aria-hidden="true">⌕</span>
                        <input type="search" placeholder="Search anything…" aria-label="Search admin content">
                    </form>
                    <button class="admin-chip">Create</button>
                    <button class="admin-icon-btn" type="button" aria-label="Notifications">🔔</button>
                    <div class="admin-avatar">
                        <span>{{ strtoupper(mb_substr($userName, 0, 2)) }}</span>
                    </div>
                </div>
            </header>

            @hasSection('toolbar')
                <section class="admin-shell__toolbar">
                    @yield('toolbar')
                </section>
            @endif

            <main class="admin-shell__content">
                @yield('content')
            </main>

            <footer class="admin-shell__footer">
                <div>
                    <strong>{{ config('app.name', 'StarterKit') }}</strong>
                    <span>Minimal admin system crafted for Laravel.</span>
                </div>
                <div class="admin-shell__footer-links">
                    <a href="mailto:support@example.com">Support</a>
                    <a href="https://laravel.com" target="_blank" rel="noreferrer">Docs</a>
                </div>
            </footer>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
