<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title', 'Admin Studio') · {{ config('app.name', 'StarterKit') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @include('starterkit::components.admin-assets')
</head>
<body class="admin-surface admin-surface--neo">
    <div class="admin-board" data-layout="neo">
        <header class="admin-board__top">
            <div class="admin-board__brand">
                <div class="admin-board__logo">{{ substr(config('app.name', 'SK'), 0, 1) }}</div>
                <div>
                    <p class="eyebrow">Live environment</p>
                    <p class="admin-board__title">@yield('page_title', 'Admin Studio')</p>
                </div>
            </div>
            <div class="admin-board__meta">
                <span>Last deploy · {{ now()->format('M d, Y') }}</span>
                <div class="admin-board__meta-actions">
                    <button class="admin-chip" type="button">Deploy</button>
                    <button class="admin-icon-btn" type="button" aria-label="Open command palette">⌘K</button>
                    <button class="admin-shell__toggle" data-sidebar-toggle aria-label="Toggle command rail">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </button>
                </div>
            </div>
        </header>

        <div class="admin-board__frame">
            <aside class="admin-board__rail" id="adminBoardRail">
                <div class="admin-board__rail-panel">
                    <p class="eyebrow">Navigation</p>
                    @include('layouts.starterkit.admin.partials.nav')
                </div>
                <div class="admin-board__rail-panel">
                    <p class="eyebrow">Shortcuts</p>
                    <div class="admin-board__shortcuts">
                        <button type="button">Create Report</button>
                        <button type="button">Invite User</button>
                        <button type="button">Generate API Key</button>
                    </div>
                </div>
            </aside>

            <main class="admin-board__canvas" id="adminBoardCanvas">
                <section class="admin-board__hero">
                    <div>
                        <h1>@yield('page_title', 'Admin Studio')</h1>
                        <p>@yield('page_subtitle', 'Beautiful glassmorphic surface for component exploration.')</p>
                    </div>
                    <div class="admin-board__hero-actions">
                        @yield('hero-actions')
                    </div>
                </section>

                <section class="admin-board__body">
                    @yield('content')
                </section>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
