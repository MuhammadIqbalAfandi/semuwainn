<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/" class="brand brand-link">
        <img src="{{ asset('img/logo-no-title.webp') }}" alt="Semuwainn Logo"
            class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-bold">Semuwainn <span
                class="brand--text-small font-weight-light">sentani</span></span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard.dashboard') }}"
                        class="nav-link {{ Route::is('dashboard.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @php
                    $routeUri = Route::currentRouteName();
                    $routeStatus = collect(['dashboard.reservations.index', 'dashboard.reservations.show', 'dashboard.service-orders.show', 'dashboard.restaurant-orders.show'])->contains($routeUri);
                @endphp
                <!-- Reservation -->
                <li class="nav-item has-treeview {{ $routeStatus ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-hotel"></i>
                        <p>
                            Pemesanan Kamar
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview active">
                        {{-- <li class="nav-item">
                            <a href="{{ route('dashboard.reservations.create') }}"
                                class="nav-link {{ Route::is('dashboard.reservations.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Pemesanan</p>
                            </a>
                        </li> --}}

                        @php
                            $routeUri = Route::currentRouteName();
                        @endphp
                        <li class="nav-item">
                            <a href="{{ route('dashboard.reservations.index') }}"
                                class="nav-link {{ $routeStatus = collect(['dashboard.reservations.index', 'dashboard.reservations.show', 'dashboard.service-orders.show', 'dashboard.restaurant-orders.show'])->contains($routeUri) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Pemesanan</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @php
                    $routeUri = Route::currentRouteName();
                    $routeStatus = collect(['dashboard.facilities.index', 'dashboard.room-types.index', 'dashboard.room-types.create', 'dashboard.room-types.edit', 'dashboard.rooms.index', 'dashboard.restaurants.index', 'dashboard.services.index', 'dashboard.users.index', 'dashboard.guests.index'])->contains($routeUri);
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
                        <li class="nav-item">
                            <a href="{{ route('dashboard.users.index') }}"
                                class="nav-link {{ Route::is('dashboard.users.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Akun User</p>
                            </a>
                        </li>

                        @php
                            $routeUri = Route::currentRouteName();
                            $routeStatus = collect(['dashboard.room-types.index', 'dashboard.room-types.create', 'dashboard.room-types.edit'])->contains($routeUri);
                        @endphp
                        <li class="nav-item">
                            <a href="{{ route('dashboard.room-types.index') }}"
                                class="nav-link {{ $routeStatus ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jenis Kamar</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.facilities.index') }}"
                                class="nav-link {{ Route::is('dashboard.facilities.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fasilitas</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.rooms.index') }}"
                                class="nav-link {{ Route::is('dashboard.rooms.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kamar</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.restaurants.index') }}"
                                class="nav-link {{ Route::is('dashboard.restaurants.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hidangan Restoran</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.services.index') }}"
                                class="nav-link {{ Route::is('dashboard.services.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Layanan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.guests.index') }}"
                                class="nav-link {{ Route::is('dashboard.guests.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tamu</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @php
                    $routeUri = Route::currentRouteName();
                    $routeStatus = collect(['dashboard.contacts.create', 'dashboard.copyrights.create', 'dashboard.privacies.create', 'dashboard.policies.create'])->contains($routeUri);
                @endphp
                <!-- Setting -->
                <li class="nav-item has-treeview {{ $routeStatus ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Pengaturan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview active">
                        <li class="nav-item">
                            <a href="{{ route('dashboard.contacts.create') }}"
                                class="nav-link {{ Route::is('dashboard.contacts.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kontak</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.copyrights.create') }}"
                                class="nav-link {{ Route::is('dashboard.copyrights.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hak Cipta</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.privacies.create') }}"
                                class="nav-link {{ Route::is('dashboard.privacies.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Privasi</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.policies.create') }}"
                                class="nav-link {{ Route::is('dashboard.policies.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kebijakan</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
