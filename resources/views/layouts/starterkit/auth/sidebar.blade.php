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
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .auth-layout-sidebar {
            display: flex;
            height: 100vh;
            background: #f9fafb;
            font-family: 'Inter', sans-serif;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #1f2937 0%, #111827 100%);
            color: white;
            padding: 32px 24px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 1000;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            margin-bottom: 48px;
            gap: 12px;
        }

        .sidebar-logo {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #00aaff 0%, #0088cc 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 24px;
        }

        .sidebar-brand {
            flex: 1;
        }

        .sidebar-brand h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .sidebar-brand p {
            font-size: 12px;
            opacity: 0.7;
        }

        .sidebar-nav {
            list-style: none;
            flex: 1;
            margin-bottom: 32px;
        }

        .sidebar-nav-item {
            margin-bottom: 8px;
        }

        .sidebar-nav-link {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
            gap: 12px;
        }

        .sidebar-nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .sidebar-nav-link.active {
            background: linear-gradient(135deg, #00aaff 0%, #0088cc 100%);
            color: white;
        }

        .sidebar-nav-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 16px;
        }

        .sidebar-footer-link {
            display: block;
            padding: 8px 0;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 13px;
            transition: color 0.3s ease;
        }

        .sidebar-footer-link:hover {
            color: white;
        }

        /* Main Content Area */
        .auth-main {
            flex: 1;
            margin-left: 280px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-y: auto;
        }

        .auth-container {
            width: 100%;
            max-width: 500px;
        }

        .auth-card {
            background: white;
            border-radius: 12px;
            padding: 48px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .auth-header {
            margin-bottom: 32px;
        }

        .auth-header h1 {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
            margin: 0 0 8px 0;
        }

        .auth-header p {
            color: #6b7280;
            font-size: 16px;
            margin: 0;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #00aaff;
            box-shadow: 0 0 0 3px rgba(0, 170, 255, 0.1);
        }

        .form-group input.is-invalid,
        .form-group textarea.is-invalid,
        .form-group select.is-invalid {
            border-color: #ef4444;
        }

        .form-group small {
            display: block;
            color: #6b7280;
            font-size: 13px;
            margin-top: 6px;
        }

        /* Form Check */
        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 16px;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            margin-right: 8px;
            cursor: pointer;
            accent-color: #00aaff;
        }

        .form-check-label {
            cursor: pointer;
            font-size: 14px;
            color: #1f2937;
        }

        .form-check-label a {
            color: #00aaff;
            text-decoration: none;
        }

        .form-check-label a:hover {
            text-decoration: underline;
        }

        /* Buttons */
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, #00aaff 0%, #0088cc 100%);
            color: white;
            margin-top: 16px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 170, 255, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        /* Links */
        .auth-links {
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
        }

        .auth-links p {
            color: #6b7280;
            font-size: 14px;
            margin: 8px 0;
        }

        .auth-links a {
            color: #00aaff;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .auth-links a:hover {
            color: #0088cc;
            text-decoration: underline;
        }

        /* Alerts */
        .alert {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 14px;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert ul {
            margin: 8px 0 0 0;
            padding-left: 20px;
        }

        .alert li {
            margin: 4px 0;
        }

        /* Invalid Feedback */
        .invalid-feedback {
            display: block;
            color: #ef4444;
            font-size: 12px;
            margin-top: 6px;
        }

        /* Toggle Button for Mobile */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 16px;
            left: 16px;
            z-index: 1001;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .auth-layout-sidebar {
                flex-direction: column;
            }

            .sidebar {
                position: fixed;
                left: -280px;
                width: 280px;
                height: 100vh;
                transition: left 0.3s ease;
                z-index: 1000;
            }

            .sidebar.active {
                left: 0;
            }

            .auth-main {
                margin-left: 0;
                width: 100%;
                padding-top: 80px;
            }

            .sidebar-toggle {
                display: block;
            }

            .auth-card {
                padding: 32px 24px;
            }

            .auth-header h1 {
                font-size: 24px;
            }

            .auth-header p {
                font-size: 14px;
            }

            .auth-container {
                max-width: 100%;
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                width: 100%;
                padding: 24px 16px;
            }

            .sidebar-header {
                margin-bottom: 24px;
            }

            .auth-main {
                padding: 16px;
                padding-top: 80px;
            }

            .auth-card {
                padding: 24px 16px;
                border-radius: 8px;
            }

            .form-group {
                margin-bottom: 18px;
            }

            .btn {
                padding: 10px 20px;
                font-size: 14px;
            }

            .auth-links {
                margin-top: 16px;
                padding-top: 16px;
            }
        }

        /* Scrollbar Styling */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.querySelector('.sidebar-toggle');
            const sidebar = document.querySelector('.sidebar');

            if (toggle) {
                toggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });

                // Close sidebar when clicking outside
                document.addEventListener('click', function(event) {
                    if (!event.target.closest('.sidebar') && !event.target.closest('.sidebar-toggle')) {
                        sidebar.classList.remove('active');
                    }
                });
            }
        });
    </script>
</head>
<body>
    <div class="auth-layout-sidebar">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    {{ substr(config('app.name', 'L'), 0, 1) }}
                </div>
                <div class="sidebar-brand">
                    <h3>{{ config('app.name', 'Laravel') }}</h3>
                    <p>Authentication</p>
                </div>
            </div>

            <!-- Navigation Items -->
            <nav class="sidebar-nav">
                @yield('sidebar-nav')
            </nav>

            <!-- Sidebar Footer Links -->
            <div class="sidebar-footer">
                @yield('sidebar-footer')
            </div>
        </aside>

        <!-- Mobile Sidebar Toggle -->
        <button class="sidebar-toggle">☰</button>

        <!-- Main Content Area -->
        <main class="auth-main">
            <div class="auth-container">
                <div class="auth-card">
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
        </main>
    </div>
</body>
</html>
