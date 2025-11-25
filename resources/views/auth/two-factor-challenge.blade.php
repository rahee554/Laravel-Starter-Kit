@extends($layout ?? \ArtflowStudio\StarterKit\Helpers\StarterKitHelper::getDefaultAuthLayoutView())

@section('title', 'Two-Factor Authentication')
@section('description', 'Enter your authentication code to continue')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="mb-4">
        <p class="text-muted text-center">
            Please enter the authentication code from your authenticator app or use one of your recovery codes.
        </p>
    </div>

    <!-- Authentication Code Form -->
    <form method="POST" action="{{ route('two-factor.login') }}" id="code-form">
        @csrf

        <div class="form-group">
            <label for="code">Authentication Code</label>
            <input 
                type="text" 
                id="code" 
                name="code" 
                class="form-control @error('code') is-invalid @enderror" 
                placeholder="000000"
                maxlength="6"
                inputmode="numeric"
                pattern="[0-9]*"
                autocomplete="one-time-code"
                autofocus
            >
            @error('code')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Verify
        </button>
    </form>

    <div class="divider">
        <span>OR</span>
    </div>

    <!-- Recovery Code Form -->
    <form method="POST" action="{{ route('two-factor.login') }}" id="recovery-form">
        @csrf

        <div class="form-group">
            <label for="recovery_code">Recovery Code</label>
            <input 
                type="text" 
                id="recovery_code" 
                name="recovery_code" 
                class="form-control @error('recovery_code') is-invalid @enderror" 
                placeholder="xxxx-xxxx-xxxx-xxxx"
            >
            @error('recovery_code')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
            <small class="form-text">
                Use one of your backup recovery codes
            </small>
        </div>

        <button type="submit" class="btn btn-outline-primary w-100">
            Use Recovery Code
        </button>
    </form>
@endsection

@section('footer-links')
    <p>
        <a href="{{ route('login') }}">← Back to Login</a>
    </p>
@endsection
