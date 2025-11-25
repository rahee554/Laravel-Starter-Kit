@extends($layout ?? \ArtflowStudio\StarterKit\Helpers\StarterKitHelper::getDefaultAdminLayoutView())

@section('title', 'Admin Dashboard Demo')

@section('content')
<div class="admin-demo">
    <h1>Admin Dashboard</h1>
    <p>This is a demo of the admin layout. The actual content would go here.</p>
    
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Users</h3>
            <p class="stat-value">1,234</p>
        </div>
        <div class="stat-card">
            <h3>Revenue</h3>
            <p class="stat-value">$45,678</p>
        </div>
        <div class="stat-card">
            <h3>Orders</h3>
            <p class="stat-value">892</p>
        </div>
        <div class="stat-card">
            <h3>Products</h3>
            <p class="stat-value">156</p>
        </div>
    </div>
    
    <div class="demo-section">
        <h2>Recent Activity</h2>
        <ul class="activity-list">
            <li>New user registration - John Doe</li>
            <li>Order #1234 completed</li>
            <li>Product "Widget Pro" updated</li>
            <li>Support ticket #567 resolved</li>
        </ul>
    </div>
</div>

<style>
    .admin-demo {
        padding: 2rem;
    }
    
    .admin-demo h1 {
        font-size: 1.75rem;
        margin-bottom: 0.5rem;
    }
    
    .admin-demo > p {
        color: #64748b;
        margin-bottom: 2rem;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .stat-card h3 {
        font-size: 0.875rem;
        color: #64748b;
        margin-bottom: 0.5rem;
    }
    
    .stat-value {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1e293b;
    }
    
    .demo-section {
        background: white;
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .demo-section h2 {
        font-size: 1.125rem;
        margin-bottom: 1rem;
    }
    
    .activity-list {
        list-style: none;
        padding: 0;
    }
    
    .activity-list li {
        padding: 0.75rem 0;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .activity-list li:last-child {
        border-bottom: none;
    }
</style>
@endsection
