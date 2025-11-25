@extends('layouts.starterkit.auth.minimal')

@section('title', 'Verify Email')
@section('description', 'Please verify your email address to continue')

@section('content')
    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success">
            A new verification link has been sent to your email address!
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="alert alert-info mb-4">
        <strong>Thanks for signing up!</strong> Before getting started, please verify your email address by clicking the link we sent you.
    </div>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-primary w-100">
            Resend Verification Email
        </button>
    </form>

    <div class="mt-4 p-3" style="background: #f8fafc; border-radius: 0.5rem;">
        <p class="text-sm text-muted mb-2">
            <strong>Didn't receive the email?</strong>
        </p>
        <ul class="text-sm text-muted mb-0">
            <li>Check your spam or junk folder</li>
            <li>Make sure you entered the correct email</li>
            <li>Click the button above to resend</li>
        </ul>
    </div>
@endsection

@section('footer-links')
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-link">
            Sign out and try a different email
        </button>
    </form>
@endsection
