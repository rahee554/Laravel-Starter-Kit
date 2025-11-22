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
        .auth-layout-hero {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #4facfe 75%, #00aaff 100%);
            background-size: 400% 400%;
            animation: gradient-shift 15s ease infinite;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
        }

        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .hero-background {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .hero-shape {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .hero-shape-1 {
            width: 300px;
            height: 300px;
            background: white;
            border-radius: 50%;
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .hero-shape-2 {
            width: 200px;
            height: 200px;
            background: white;
            border-radius: 50%;
            top: 70%;
            right: 10%;
            animation-delay: 1s;
        }

        .hero-shape-3 {
            width: 150px;
            height: 150px;
            background: white;
            border-radius: 50%;
            bottom: 15%;
            left: 50%;
            animation-delay: 2s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(30px) scale(1.1); }
        }

        .hero-container {
            position: relative;
            z-index: 10;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .hero-content-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            max-width: 1200px;
            width: 100%;
            align-items: center;
        }

        .hero-text-section {
            color: white;
            z-index: 20;
        }

        .hero-text-section h2 {
            font-size: 48px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 24px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .hero-text-section p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 24px;
            opacity: 0.9;
            max-width: 450px;
        }

        .hero-features {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .hero-features li {
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            font-size: 16px;
        }

        .hero-features li:before {
            content: "✓";
            display: inline-block;
            width: 24px;
            height: 24px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            text-align: center;
            line-height: 24px;
            margin-right: 12px;
            font-weight: 700;
        }

        .hero-form-section {
            background: white;
            border-radius: 16px;
            padding: 48px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            z-index: 20;
            position: relative;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-group input:focus {
            outline: none;
            border-color: #00aaff;
            box-shadow: 0 0 0 3px rgba(0, 170, 255, 0.1);
        }

        .form-group input.is-invalid {
            border-color: #ef4444;
        }

        .btn-primary {
            width: 100%;
            padding: 12px 24px;
            background: linear-gradient(135deg, #00aaff 0%, #0088cc 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 16px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 170, 255, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .auth-links {
            text-align: center;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #e5e7eb;
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

        /* Responsive Design */
        @media (max-width: 1024px) {
            .hero-content-wrapper {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .hero-text-section h2 {
                font-size: 36px;
            }

            .hero-form-section {
                padding: 40px;
            }

            .hero-shape-1,
            .hero-shape-2,
            .hero-shape-3 {
                opacity: 0.05;
            }
        }

        @media (max-width: 768px) {
            .auth-layout-hero {
                padding: 20px;
                min-height: 100vh;
            }

            .hero-container {
                flex-direction: column;
            }

            .hero-content-wrapper {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .hero-text-section {
                text-align: center;
            }

            .hero-text-section h2 {
                font-size: 28px;
            }

            .hero-text-section p {
                font-size: 16px;
            }

            .hero-features li:before {
                display: none;
            }

            .hero-features li {
                font-size: 14px;
            }

            .hero-form-section {
                width: 100%;
                max-width: 400px;
                padding: 32px 24px;
            }

            .auth-header h1 {
                font-size: 24px;
            }

            .auth-header p {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .hero-text-section h2 {
                font-size: 24px;
                margin-bottom: 16px;
            }

            .hero-text-section p {
                font-size: 14px;
                margin-bottom: 16px;
            }

            .hero-form-section {
                padding: 24px;
            }

            .form-group {
                margin-bottom: 18px;
            }

            .btn-primary {
                padding: 10px 20px;
                font-size: 14px;
            }
        }

        /* Alert Styles */
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

        /* Form Checkbox */
        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
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

        /* Invalid Feedback */
        .invalid-feedback {
            display: block;
            color: #ef4444;
            font-size: 12px;
            margin-top: 6px;
        }
    </style>
</head>
<body>
    <div class="auth-layout-hero">
        <!-- Floating Background Shapes -->
        <div class="hero-background">
            <div class="hero-shape hero-shape-1"></div>
            <div class="hero-shape hero-shape-2"></div>
            <div class="hero-shape hero-shape-3"></div>
        </div>

        <!-- Hero Container -->
        <div class="hero-container">
            <div class="hero-content-wrapper">
                <!-- Left: Hero Text Section -->
                <div class="hero-text-section">
                    <h2>@yield('hero-title', 'Welcome to ' . config('app.name', 'Laravel'))</h2>
                    <p>@yield('hero-description', 'Build amazing things with our secure authentication system. Get started in minutes.')</p>
                    
                    @hasSection('hero-features')
                        <ul class="hero-features">
                            @yield('hero-features')
                        </ul>
                    @else
                        <ul class="hero-features">
                            <li>Secure and reliable authentication</li>
                            <li>Two-factor authentication support</li>
                            <li>Email verification included</li>
                        </ul>
                    @endif
                </div>

                <!-- Right: Form Section -->
                <div class="hero-form-section">
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
            </div>
        </div>

        <!-- Footer Links -->
        @hasSection('footer-links')
            <div style="position: absolute; bottom: 24px; left: 50%; transform: translateX(-50%); z-index: 20; width: 100%; text-align: center;">
                <div class="auth-links" style="border-top: 1px solid rgba(255,255,255,0.2); padding-top: 24px;">
                    <div style="color: rgba(255,255,255,0.8);">
                        @yield('footer-links')
                    </div>
                </div>
            </div>
        @endif
    </div>
</body>
</html>
