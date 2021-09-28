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
                'reservation.index',
                'reservation.create'
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
                            <a href="{{ route('reservation.create') }}"
                                class="nav-link {{ Route::is('reservation.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Pemesanan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('reservation.index') }}"
                                class="nav-link {{ Route::is('reservation.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Pemesanan</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @php
                $routeUri = Route::currentRouteName();
                $routeStatus = collect([
                'facility.index',
                'room-type.index',
                'room.index',
                'restaurant.index',
                'service.index',
                'user.index',
                'guest.index',
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
                            <a href="{{ route('user.index') }}"
                                class="nav-link {{ Route::is('user.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Akun User</p>
                            </a>
                        </li>

                        @php
                        $routeUri = Route::currentRouteName();
                        $routeStatus = collect([
                        'room-type.index',
                        'room-type.create',
                        'room-type.edit',
                        ])->contains($routeUri);
                        @endphp
                        <!-- Room Type -->
                        <li class="nav-item">
                            <a href="{{ route('room-type.index') }}"
                                class="nav-link {{ $routeStatus ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jenis Kamar</p>
                            </a>
                        </li>

                        <!-- Facility -->
                        <li class="nav-item">
                            <a href="{{ route('facility.index') }}"
                                class="nav-link {{ Route::is('facility.index') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fasilitas</p>
                            </a>
                        </li>

                        <!-- Room -->
                        <li class="nav-item">
                            <a href="{{ route('room.index') }}"
                                class="nav-link {{ Route::is('room.index') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kamar</p>
                            </a>
                        </li>

                        <!-- Restaurant -->
                        <li class="nav-item">
                            <a href="{{ route('restaurant.index') }}"
                                class="nav-link {{ Route::is('restaurant.index') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hidangan Restoran</p>
                            </a>
                        </li>

                        <!-- Service -->
                        <li class="nav-item">
                            <a href="{{ route('service.index') }}"
                                class="nav-link {{ Route::is('service.index') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Layanan</p>
                            </a>
                        </li>

                        <!-- Guest -->
                        <li class="nav-item">
                            <a href="{{ route('guest.index') }}"
                                class="nav-link {{ Route::is('guest.index') ? 'active' : ''}}">
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
