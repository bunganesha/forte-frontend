<aside class="sidenav navbar navbar-vertical navbar-expand-xs fixed-start" id="sidenav-main">
    <div class="sidenav-header">
        {{-- TOMBOL CLOSE (Hanya muncul di Mobile) --}}
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>

        <a class="navbar-brand text-white m-0 d-flex align-items-center" href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/img/forte.png') }}" class="navbar-brand-img h-100" alt="logo">
        </a>
    </div>

    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">

            @hasanyrole('user')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm shadow-none border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-white fs-4 text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('power') ? 'active' : '' }}"
                    href="{{ route('power') }}">
                    <div
                        class="icon icon-shape icon-sm shadow-none border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-sound-wave text-white fs-4 text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Power Station</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('map') ? 'active' : '' }}" href="/map">
                    <div
                        class="icon icon-shape icon-sm shadow-none border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="bi bi-map text-white fs-4 text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Map</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('table-data') ? 'active' : '' }}" href="{{ route('table-data') }}">
                    <div
                        class="icon icon-shape icon-sm shadow-none border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-white fs-4 text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Tables</span>
                </a>
            </li>
            @endhasanyrole

            {{-- Menu dari kode pertama, hanya untuk admin & superadmin --}}
            @hasanyrole('admin')
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm shadow-none border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-white fs-4 text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <div
                        class="icon icon-shape icon-sm shadow-none border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-success fs-4 text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Manage Users</span>
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->is('admin.sensors') ? 'active' : '' }}" href="/admin/sensors">
                    <div
                        class="icon icon-shape icon-sm shadow-none border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-white fs-4 text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Manage Sensors</span>
                </a>
            </li> --}}
            @endhasanyrole
            @hasanyrole('supervisor')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('map') ? 'active' : '' }}" href="/map">
                    <div
                        class="icon icon-shape icon-sm shadow-none border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="bi bi-map text-white fs-4 text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Map</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin.reports') ? 'active' : '' }}" href="/admin/reports">
                    <div
                        class="icon icon-shape icon-sm shadow-none border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-white fs-4 text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1 text-white">Validation Reports</span>
                </a>
            </li>
            @endhasanyrole

        </ul>
    </div>
</aside>
