@extends($layout ?? \ArtflowStudio\StarterKit\Helpers\StarterKitHelper::getDefaultAuthLayoutView())

@section('title', 'Reset Password')
@section('description', 'Create a new password to regain access to your account')

@section('content')
    <form method="POST" action="{{ route('password.update') }}" novalidate>
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="form-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                name="email" value="{{ old('email', $request->email) }}" 
                required autofocus placeholder="you@example.com">
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">New Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required placeholder="Minimum 8 characters">
            <small class="form-text text-muted">Use at least 8 characters for better security</small>
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" type="password"
                class="form-control @error('password_confirmation') is-invalid @enderror" 
                name="password_confirmation" required placeholder="Re-enter your password">
            @error('password_confirmation')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100 mt-4">
            Reset Password
        </button>
    </form>
@endsection

@section('footer-links')
    <p>
        Remember your password?
        <a href="{{ route('login') }}">Sign in here</a>
    </p>
@endsection