<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarterKit Layout Showcase</title>
    <link href="{{ asset('vendor/artflow-studio/starterkit/assets/auth.css') }}" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #64748b;
            --success: #22c55e;
            --background: #f8fafc;
            --surface: #ffffff;
            --text: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--background);
            color: var(--text);
            line-height: 1.6;
        }
        
        .showcase-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
        }
        
        .showcase-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .showcase-header p {
            font-size: 1.125rem;
            opacity: 0.9;
        }
        
        .current-config {
            background: rgba(255,255,255,0.1);
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1.5rem;
            display: inline-block;
        }
        
        .current-config code {
            background: rgba(255,255,255,0.2);
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-family: 'Fira Code', monospace;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--border);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .section-title .icon {
            font-size: 1.25rem;
        }
        
        .layout-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }
        
        .layout-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        
        .layout-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1);
            border-color: var(--primary);
        }
        
        .layout-card-preview {
            height: 160px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }
        
        .layout-card-preview::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60px;
            height: 60px;
            background: rgba(255,255,255,0.2);
            border-radius: 8px;
        }
        
        .layout-card-content {
            padding: 1.25rem;
        }
        
        .layout-card-title {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text);
        }
        
        .layout-card-description {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-bottom: 1rem;
        }
        
        .layout-card-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
        }
        
        .btn-primary {
            background: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background: var(--primary-dark);
        }
        
        .btn-secondary {
            background: var(--background);
            color: var(--text);
            border: 1px solid var(--border);
        }
        
        .btn-secondary:hover {
            background: var(--border);
        }
        
        .info-box {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .info-box h3 {
            color: #1e40af;
            margin-bottom: 0.75rem;
            font-size: 1rem;
        }
        
        .info-box code {
            background: #dbeafe;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-family: 'Fira Code', monospace;
            font-size: 0.875rem;
        }
        
        .info-box ul {
            margin-left: 1.5rem;
            margin-top: 0.5rem;
        }
        
        .info-box li {
            color: #1e40af;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 500;
            border-radius: 4px;
            margin-left: 0.5rem;
        }
        
        .badge-active {
            background: #dcfce7;
            color: #166534;
        }
    </style>
</head>
<body>
    <header class="showcase-header">
        <h1>🎨 StarterKit Layout Showcase</h1>
        <p>Preview and test all available authentication and admin layouts</p>
        <div class="current-config">
            <strong>Current Config:</strong> 
            <code>auth_layout: {{ config('starterkit.auth_layout', 'particles') }}</code>
        </div>
    </header>
    
    <div class="container">
        <div class="info-box">
            <h3>📌 How to Change Layouts</h3>
            <p>Set the layout in your <code>.env</code> file or <code>config/starterkit.php</code>:</p>
            <ul>
                <li><code>STARTERKIT_AUTH_LAYOUT=particles</code> (in .env)</li>
                <li><code>'auth_layout' => 'particles'</code> (in config/starterkit.php)</li>
            </ul>
        </div>

        <h2 class="section-title">
            <span class="icon">🔐</span>
            Authentication Layouts
            <span class="badge badge-active">{{ count($auth_layouts) }} layouts</span>
        </h2>
        
        <div class="layout-grid">
            @foreach($auth_layouts as $key => $description)
                <div class="layout-card">
                    <div class="layout-card-preview" style="background: linear-gradient(135deg, {{ ['centered' => '#667eea, #764ba2', 'split' => '#f093fb, #f5576c', 'minimal' => '#4facfe, #00f2fe', 'glass' => '#a8edea, #fed6e3', 'particles' => '#0f0c29, #302b63', 'hero' => '#11998e, #38ef7d', 'modern' => '#fc466b, #3f5efb', '3d' => '#000428, #004e92', 'premium-dark' => '#232526, #414345', 'gradient-flow' => '#ee0979, #ff6a00', 'clean' => '#dfe6e9, #b2bec3', 'hero-grid' => '#8360c3, #2ebf91', 'sidebar' => '#1a1a2e, #16213e', 'base' => '#f8fafc, #e2e8f0'][$key] ?? '#667eea, #764ba2' }});">
                    </div>
                    <div class="layout-card-content">
                        <h3 class="layout-card-title">
                            {{ ucfirst(str_replace('-', ' ', $key)) }}
                            @if(config('starterkit.auth_layout') === $key)
                                <span class="badge badge-active">Active</span>
                            @endif
                        </h3>
                        <p class="layout-card-description">{{ $description }}</p>
                        <div class="layout-card-actions">
                            <a href="{{ route('test.auth.' . $key) }}" class="btn btn-primary">Preview</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <h2 class="section-title">
            <span class="icon">⚙️</span>
            Admin Layouts
            <span class="badge badge-active">{{ count($admin_layouts) }} layouts</span>
        </h2>
        
        <div class="layout-grid">
            @foreach($admin_layouts as $key => $description)
                <div class="layout-card">
                    <div class="layout-card-preview" style="background: linear-gradient(135deg, {{ ['sidebar' => '#1a1a2e, #16213e', 'topnav' => '#0f3443, #34e89e', 'minimal' => '#f5f7fa, #c3cfe2', 'neo' => '#0f0c29, #302b63', 'classic' => '#243B55, #141E30'][$key] ?? '#667eea, #764ba2' }});">
                    </div>
                    <div class="layout-card-content">
                        <h3 class="layout-card-title">
                            {{ ucfirst(str_replace('-', ' ', $key)) }}
                            @if(config('starterkit.admin_layout') === $key)
                                <span class="badge badge-active">Active</span>
                            @endif
                        </h3>
                        <p class="layout-card-description">{{ $description }}</p>
                        <div class="layout-card-actions">
                            <a href="{{ route('test.admin.' . $key) }}" class="btn btn-primary">Preview</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
