<x-PDF-layout title="Detail Pemesanan">
    <main>
        <x-shared.content>
            <x-reservation-pdf.detail-info :reservation="$reservation" :nightCount="$nightCount">
            </x-reservation-pdf.detail-info>

            <x-reservation-pdf.table-room :reservation="$reservation" :totalRoomPriceString="$totalRoomPriceString">
            </x-reservation-pdf.table-room>

            <x-reservation-pdf.table-service :reservation="$reservation" :roomOrders="$reservation"
                :totalServicePriceString="$totalServicePriceString">
            </x-reservation-pdf.table-service>

            <x-reservation-pdf.table-restaurant :reservation="$reservation"
                :totalRestaurantPriceString="$totalRestaurantPriceString">
            </x-reservation-pdf.table-restaurant>

            <x-reservation-pdf.total-price :totalPrice="$totalPrice"></x-reservation-pdf.total-price>
        </x-shared.content>
    </main>
</x-PDF-layout>
