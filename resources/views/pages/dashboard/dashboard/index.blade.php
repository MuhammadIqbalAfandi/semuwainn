<x-dashboard-layout title="Dashboard">
    <x-dashboard-content-wrapper>
        <x-dashboard-content-header title="Dashboard">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-warning">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </x-slot>
        </x-dashboard-content-header>

        <x-dashboard-content>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    <!-- Room Type -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $roomTypeCount }}</h3>

                            <p>Jenis Kamar</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-door-open"></i>
                        </div>
                        <a href="{{ route('room-type.index') }}" class="small-box-footer">
                            Lihat detailnya <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12">
                    <!-- Room -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $roomCount }}</h3>

                            <p>Kamar</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-bed"></i>
                        </div>
                        <a href="{{ route('room.index') }}" class="small-box-footer">
                            Lihat detailnya <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12">
                    <!-- Service -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $serviceCount }}</h3>

                            <p>Layanan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-concierge-bell"></i>
                        </div>
                        <a href="{{ route('service.index') }}" class="small-box-footer">
                            Lihat detailnya <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12">
                    <!-- Restaurant -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $restaurantCount }}</h3>

                            <p>Hidangan Restoran</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <a href="{{ route('restaurant.index') }}" class="small-box-footer">
                            Lihat detailnya <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12">
                    <!-- Guest -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $guestCount }}</h3>

                            <p>Tamu</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ route('guest.index') }}" class="small-box-footer">
                            Lihat detailnya <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </x-dashboard-content>
    </x-dashboard-content-wrapper>
</x-dashboard-layout>
