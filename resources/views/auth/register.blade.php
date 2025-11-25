@extends('layouts.starterkit.auth.clean')

@section('title', 'Create Account')
@section('description', 'Join us and start your journey today')

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name">Full Name</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                   name="name" value="{{ old('name') }}" required autofocus 
                   placeholder="Enter your full name">
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                   name="email" value="{{ old('email') }}" required 
                   placeholder="Enter your email">
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                   name="password" required 
                   placeholder="Minimum 8 characters">
            <small class="form-text text-muted">Must be at least 8 characters long</small>
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

        <div class="form-check">
            <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" 
                   name="terms" id="terms" required {{ old('terms') ? 'checked' : '' }}>
            <label class="form-check-label" for="terms">
                I agree to the <a href="#">Terms & Conditions</a>
            </label>
            @error('terms')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100 mt-4">
            Create Account
        </button>
    </form>
@endsection

@section('footer-links')
    <p>Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
@endsection