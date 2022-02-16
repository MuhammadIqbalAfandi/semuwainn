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
            <x-dashboard.reservation.show.detail-info :reservation="$reservation" :nightCount="$nightCount">
            </x-dashboard.reservation.show.detail-info>

            <x-dashboard.reservation.show.table-room :reservation="$reservation" :roomBillString="$roomBillString"
                :nightCount="$nightCount">
            </x-dashboard.reservation.show.table-room>

            <x-dashboard.reservation.show.table-service :reservation="$reservation"
                :serviceBillString="$serviceBillString" :nightCount="$nightCount">
            </x-dashboard.reservation.show.table-service>

            <x-dashboard.reservation.show.table-restaurant :reservation="$reservation"
                :restaurantBillString="$restaurantBillString">
            </x-dashboard.reservation.show.table-restaurant>

            <x-dashboard.reservation.show.total-price :reservation="$reservation" :restOfBill="$restOfBill"
                :payment="$payment">
            </x-dashboard.reservation.show.total-price>
        </x-shared.content>
    </x-shared.content-wrapper>
</x-dashboard-layout>
