@extends($layout ?? \ArtflowStudio\StarterKit\Helpers\StarterKitHelper::getDefaultAuthLayoutView())

@section('title', 'Sign In')
@section('description', 'Welcome back! Please enter your credentials')

@section('content')
    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" 
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" 
                placeholder="you@example.com"
                required autofocus>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password"
                class="form-control @error('password') is-invalid @enderror" 
                placeholder="Enter your password" 
                required>
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group-row">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    Remember me
                </label>
            </div>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="btn-link">
                    Forgot password?
                </a>
            @endif
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Sign In
        </button>
    </form>
@endsection

@if(config('fortify.features') && in_array('registration', config('fortify.features')) && Route::has('register'))
    @section('footer-links')
        <p>
            Don't have an account?
            <a href="{{ route('register') }}">Create one now</a>
        </p>
    @endsection
@endif