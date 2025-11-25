@extends($layout ?? \ArtflowStudio\StarterKit\Helpers\StarterKitHelper::getDefaultAuthLayoutView())

@section('title', 'Confirm Password')
@section('description', 'Please confirm your password to continue')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="alert alert-info mb-4">
        This is a secure area. Please confirm your password before continuing.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="form-group">
            <label for="password">Password</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="form-control @error('password') is-invalid @enderror" 
                placeholder="Enter your password"
                required 
                autofocus
            >
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Confirm
        </button>
    </form>
@endsection
