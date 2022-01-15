<x-dashboard-layout title="Dashboard">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Dashboard">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-warning">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $roomTypeCount }}</h3>

                            <p>Jenis Kamar</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-door-open"></i>
                        </div>
                        <a href="{{ route('dashboard.room-types.index') }}" class="small-box-footer">
                            Lihat Detailnya <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $roomCount }}</h3>

                            <p>Kamar</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-bed"></i>
                        </div>
                        <a href="{{ route('dashboard.rooms.index') }}" class="small-box-footer">
                            Lihat Detailnya <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $serviceCount }}</h3>

                            <p>Layanan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-concierge-bell"></i>
                        </div>
                        <a href="{{ route('dashboard.services.index') }}" class="small-box-footer">
                            Lihat Detailnya <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $restaurantCount }}</h3>

                            <p>Hidangan Restoran</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <a href="{{ route('dashboard.restaurants.index') }}" class="small-box-footer">
                            Lihat Detailnya <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $guestCount }}</h3>

                            <p>Tamu</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ route('dashboard.guests.index') }}" class="small-box-footer">
                            Lihat Detailnya <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $remainingRoom }}</h3>

                            <p>Kamar Tersedia</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-bed"></i>
                        </div>
                        <p class="small-box-footer text-dark">
                            Detail Tidak Tersedia
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-shared.content>
    </x-shared.content-wrapper>

    @push('scripts')
        <script>
            // Mounted
            fetchCartData()

            let areaChartData = {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
                    'November', 'Desember',
                ],
                datasets: [{
                    label: 'Ruangan Dipesan',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(255,193,7,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(255,193,7,1)',
                    data: [28, 48, 40, 19, 86, 27, 90, 100, 1001]
                }]
            }

            let barChartCanvas = $('#barChart').get(0).getContext('2d')
            let barChartData = $.extend(true, {}, areaChartData)
            let temp0 = areaChartData.datasets[0]
            barChartData.datasets[0] = temp0

            let barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })
            // end Mounted

            // Methods
            function fetchCartData() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    type: 'get',
                    url: '/dashboard/charts',
                    success(res) {
                        console.log("🚀 ~ file: index.blade.php ~ line 167 ~ success ~ res", res)
                    }
                })
            }
            // end Methods
        </script>
    @endpush
</x-dashboard-layout>
