<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand brand-link">
        <img src="{{ asset('img/logo-no-title.webp') }}" alt="Semuwainn Logo"
            class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-bold">Semuwainn <span
                class="brand--text-small font-weight-light">sentani</span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @php
                $routeUri = Route::currentRouteName();
                $routeStatus = collect([
                'reservations.index',
                'reservations.create'
                ])->contains($routeUri);
                @endphp
                <!-- Pemesanan Kamar -->
                <li class="nav-item has-treeview {{ $routeStatus ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-hotel"></i>
                        <p>
                            Pemesanan Kamar
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview active">
                        <li class="nav-item">
                            <a href="{{ route('reservations.create') }}"
                                class="nav-link {{ Route::is('reservations.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Pemesanan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('reservations.index') }}"
                                class="nav-link {{ Route::is('reservations.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Pemesanan</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @php
                $routeUri = Route::currentRouteName();
                $routeStatus = collect([
                'facilities.index',
                'room-types.index',
                'rooms.index',
                'restaurants.index',
                'services.index',
                'users.index',
                'guests.index',
                ])->contains($routeUri);
                @endphp
                <!-- Master -->
                <li class="nav-item has-treeview {{ $routeStatus ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-toolbox"></i>
                        <p>
                            Master
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview active">
                        <!-- Account User -->
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}"
                                class="nav-link {{ Route::is('users.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Akun User</p>
                            </a>
                        </li>

                        @php
                        $routeUri = Route::currentRouteName();
                        $routeStatus = collect([
                        'room-types.index',
                        'room-types.create',
                        'room-types.edit',
                        ])->contains($routeUri);
                        @endphp
                        <!-- Room Type -->
                        <li class="nav-item">
                            <a href="{{ route('room-types.index') }}"
                                class="nav-link {{ $routeStatus ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jenis Kamar</p>
                            </a>
                        </li>

                        <!-- Facility -->
                        <li class="nav-item">
                            <a href="{{ route('facilities.index') }}"
                                class="nav-link {{ Route::is('facilities.index') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fasilitas</p>
                            </a>
                        </li>

                        <!-- Room -->
                        <li class="nav-item">
                            <a href="{{ route('rooms.index') }}"
                                class="nav-link {{ Route::is('rooms.index') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kamar</p>
                            </a>
                        </li>

                        <!-- Restaurant -->
                        <li class="nav-item">
                            <a href="{{ route('restaurants.index') }}"
                                class="nav-link {{ Route::is('restaurants.index') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hidangan Restoran</p>
                            </a>
                        </li>

                        <!-- Service -->
                        <li class="nav-item">
                            <a href="{{ route('services.index') }}"
                                class="nav-link {{ Route::is('services.index') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Layanan</p>
                            </a>
                        </li>

                        <!-- Guest -->
                        <li class="nav-item">
                            <a href="{{ route('guests.index') }}"
                                class="nav-link {{ Route::is('guests.index') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tamu</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
