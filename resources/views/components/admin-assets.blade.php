<!-- Admin Assets Component -->
@php
    $adminCss = config('starterkit.assets.admin.css', 'vendor/artflow-studio/starterkit/assets/admin.css');
    $adminJs = config('starterkit.assets.admin.js', 'vendor/artflow-studio/starterkit/assets/admin.js');
@endphp

<link rel="stylesheet" href="{{ asset($adminCss) }}">
<script src="{{ asset($adminJs) }}" defer></script>
