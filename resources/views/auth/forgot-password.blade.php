@extends($layout ?? \ArtflowStudio\StarterKit\Helpers\StarterKitHelper::getDefaultAuthLayoutView())

@section('title', 'Reset Password')
@section('description', "Enter your email and we'll send you a reset link")

@section('content')
    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                   name="email" value="{{ old('email') }}" required autofocus 
                   placeholder="Enter your email address">
            <small class="form-text text-muted">We'll send you a link to reset your password</small>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100 mt-4">
            Send Reset Link
        </button>
    </form>
@endsection

@section('footer-links')
    <p><a href="{{ route('login') }}">Back to Login</a></p>
    @if(Route::has('register'))
        <p>Don't have an account? <a href="{{ route('register') }}">Create one now</a></p>
    @endif
@endsection
