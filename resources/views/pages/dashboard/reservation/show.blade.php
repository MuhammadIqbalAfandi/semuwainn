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
            <x-reservation.show.detail-info :reservation="$reservation" :nightCount="$nightCount">
            </x-reservation.show.detail-info>

            <x-reservation.show.table-room :reservation="$reservation" :totalRoomPriceString="$totalRoomPriceString">
            </x-reservation.show.table-room>

            <x-reservation.show.table-service :reservation="$reservation" :roomOrders="$reservation"
                :totalServicePriceString="$totalServicePriceString">
            </x-reservation.show.table-service>

            <x-reservation.show.table-restaurant :reservation="$reservation"
                :totalRestaurantPriceString="$totalRestaurantPriceString">
            </x-reservation.show.table-restaurant>

            <x-reservation.show.total-price :totalPrice="$totalPrice"></x-reservation.show.total-price>
        </x-shared.content>
    </x-shared.content-wrapper>

    @prepend('scripts')
        <script>
            // Methods
            function reloadPage() {
                location.reload()
            }
            // end Methods
        </script>
    @endprepend
</x-dashboard-layout>
