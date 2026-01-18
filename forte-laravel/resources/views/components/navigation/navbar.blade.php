{{-- Component untuk Navbar dengan links yang dinamis --}}
@props(['items' => [], 'userInitial' => 'AH', 'userName' => 'Guest'])

<nav class="navbar navbar-expand-lg navbar-forte navbar-dark">
    <div class="container-fluid">
        {{-- Logo --}}
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/img/FORTE.png') }}" alt="FORTE Logo">
        </a>

        {{-- Toggle Button --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Navigation Links --}}
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                @foreach ($items as $item)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs($item['route']) ? 'active' : '' }}"
                            href="{{ route($item['route']) }}">
                            {{ $item['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- User Profile Pill --}}
        @if (Auth::check())
            <div class="d-none d-lg-flex align-items-center ms-3">
                <div
                    class="d-flex align-items-center gap-2 px-3 py-2 rounded-pill border border-secondary bg-dark bg-opacity-50">
                    {{-- Avatar --}}
                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-success text-white fw-semibold"
                        style="width:35px;height:35px;font-size:0.8rem;">
                        {{ strtoupper(substr(Auth::user()->username ?? 'AH', 0, 2)) }}
                    </div>

                    {{-- Username --}}
                    <span class="text-white small fw-medium">
                        {{ Auth::user()->username ?? 'User' }}
                    </span>
                </div>
        @endif
    </div>
</nav>
