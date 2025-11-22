@php
    $navLinks = [
        [
            'label' => 'Dashboard',
            'href' => url('/admin'),
            'abbr' => 'DB',
            'pattern' => 'admin'
        ],
        [
            'label' => 'Components',
            'href' => url('/admin/components'),
            'abbr' => 'UI',
            'pattern' => 'admin/components'
        ],
        [
            'label' => 'Users',
            'href' => url('/admin/users'),
            'abbr' => 'US',
            'pattern' => 'admin/users'
        ],
        [
            'label' => 'Profile',
            'href' => url('/admin/profile'),
            'abbr' => 'PR',
            'pattern' => 'admin/profile'
        ],
        [
            'label' => 'Settings',
            'href' => url('/admin/settings'),
            'abbr' => 'ST',
            'pattern' => 'admin/settings'
        ],
    ];
@endphp

<ul class="admin-nav-list" role="list">
    @foreach ($navLinks as $link)
        @php
            $isActive = request()->is($link['pattern']) || request()->is($link['pattern'].'/*');
        @endphp
        <li>
            <a href="{{ $link['href'] }}" class="admin-nav-link {{ $isActive ? 'is-active' : '' }}">
                <span class="admin-nav-link__icon" aria-hidden="true">{{ $link['abbr'] }}</span>
                <span class="admin-nav-link__label">{{ $link['label'] }}</span>
            </a>
        </li>
    @endforeach
</ul>
