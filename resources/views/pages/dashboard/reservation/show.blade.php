<x-dashboard-layout title="Detail Pemesanan">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Detail Pemesanan">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.reservations.index') }}"
                        class="text-warning">Daftar
                        Pemesanan Kamar</a></li>
                <li class="breadcrumb-item active">Detail Pemesanan</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-12">
                            <p>Pemesan</p>
                            <p>{{ $reservation->guest->name }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p>Nomor Pemesanan</p>
                            <p>{{ $reservation->reservation_number }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p>Tanggal Pemesanan</p>
                            <p>{{ $reservation->reservation_time }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="row">
                        <div class="col text-right">
                            <p> Terakhir Diubah Oleh</p>
                            <p>{{ $reservation->user->name ?? '' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-right">
                            <p>Status Pemesanan</p>
                            <p>{{ $reservation->reservationStatus->name }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-right">
                            <p>Total Harga</p>
                            <p>{{ $totalPrice }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-auto mr-3">
                    <p>Checkin</p>
                    <p>{{ $reservation->check_in }}</p>
                </div>
                <div class="col-auto mr-3">
                    <p>Checkout</p>
                    <p>{{ $reservation->check_out }}</p>
                </div>
                <div class="col-auto">
                    <p>Lama Inap</p>
                    <p>{{ $nightCount }} Hari</p>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-auto mr-3">
                    <p>Total Tamu</p>
                    <p>{{ $reservation->roomOrders->pluck('guest_count')->count() }}</p>
                </div>
                <div class="col-auto mr-3">
                    <p>Total Kamar</p>
                    <p>{{ $reservation->roomOrders->pluck('guest_count')->count() }}</p>
                </div>
                <div class="col-auto mr-3">
                    <p>Total Layanan</p>
                    <p>{{ $reservation->serviceOrders->pluck('quantity')->count() }}</p>
                </div>
                <div class="col-auto">
                    <p>Total Hidangan</p>
                    <p>{{ $reservation->restaurantOrders->pluck('quantity')->count() }}</p>
                </div>
            </div>

            <x-reservation.show.table-room :reservation="$reservation" :totalRoomPriceString="$totalRoomPriceString">
            </x-reservation.show.table-room>
            <x-reservation.show.table-service :reservation="$reservation" :roomOrders="$reservation"
                :totalServicePriceString="$totalServicePriceString">
            </x-reservation.show.table-service>
            <x-reservation.show.table-restaurant :reservation="$reservation"
                :totalRestaurantPriceString="$totalRestaurantPriceString">
            </x-reservation.show.table-restaurant>
        </x-shared.content>
    </x-shared.content-wrapper>
</x-dashboard-layout>
