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
    @include('starterkit::components.auth-assets')
</head>
<body>
    <!-- Layout 2: Split Screen -->
    <div class="auth-layout-split">
        <div class="auth-left">
            <div class="logo-area">
                <div class="logo-placeholder">
                    {{ substr(config('app.name', 'L'), 0, 1) }}
                </div>
                <h2>{{ config('app.name', 'Laravel') }}</h2>
                <p>@yield('left-content', 'Welcome to our platform. Build amazing things with modern authentication.')</p>
            </div>
        </div>

        <div class="auth-right">
            <div class="auth-container">
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

                <div class="auth-card">
                    <div class="auth-header">
                        <h1>@yield('title')</h1>
                        @hasSection('description')
                            <p>@yield('description')</p>
                        @endif
                    </div>

                    @yield('content')
                </div>

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
