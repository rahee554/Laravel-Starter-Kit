<!-- Auth Assets Component -->
@php
    $authCss = config('starterkit.assets.auth.css', 'vendor/artflow-studio/starterkit/assets/auth.css');
    $authJs = config('starterkit.assets.auth.js', 'vendor/artflow-studio/starterkit/assets/auth.js');
@endphp

<link rel="stylesheet" href="{{ asset($authCss) }}">
<script src="{{ asset($authJs) }}" defer></script>
