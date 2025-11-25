@extends($layout ?? \ArtflowStudio\StarterKit\Helpers\StarterKitHelper::getDefaultAuthLayoutView())

@section('page_title', 'Create New Password')

@section('content')
<div class="auth-card">
    <div class="auth-header">
        <div class="logo-placeholder">L</div>
        <h1>Create New Password</h1>
        <p>Enter a new password to regain access</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="form-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                   name="email" value="{{ old('email', $request->email) }}" required autofocus 
                   placeholder="Enter your email">
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">New Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                   name="password" required 
                   placeholder="Minimum 8 characters">
            <small class="form-text text-muted">Use at least 8 characters for better security</small>
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                   name="password_confirmation" required 
                   placeholder="Re-enter your password">
            @error('password_confirmation')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100 mt-4">
            Reset Password
        </button>
    </form>

    <div class="auth-links">
        <p><a href="{{ route('login') }}">Back to Login</a></p>
    </div>
</div>
@endsection
