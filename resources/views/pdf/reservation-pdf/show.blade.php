<x-PDF-layout title="Detail Pemesanan">
    <main>
        <x-shared.content>
            <x-reservation-pdf.logo></x-reservation-pdf.logo>

            <section style="border-bottom: 1px dashed black"></section>

            <x-reservation-pdf.detail-info :reservation="$reservation" :nightCount="$nightCount">
            </x-reservation-pdf.detail-info>

            <section style="border-bottom: 1px dashed black"></section>

            <x-reservation-pdf.table-room :reservation="$reservation" :totalRoomPriceString="$totalRoomPriceString">
            </x-reservation-pdf.table-room>

            <section style="border-bottom: 1px dashed black"></section>

            <x-reservation-pdf.table-service :reservation="$reservation" :roomOrders="$reservation"
                :totalServicePriceString="$totalServicePriceString">
            </x-reservation-pdf.table-service>

            <section style="border-bottom: 1px dashed black"></section>

            <x-reservation-pdf.table-restaurant :reservation="$reservation"
                :totalRestaurantPriceString="$totalRestaurantPriceString">
            </x-reservation-pdf.table-restaurant>

            <x-reservation-pdf.total-price :totalPrice="$totalPrice"></x-reservation-pdf.total-price>

            <x-reservation-pdf.note></x-reservation-pdf.note>
        </x-shared.content>
    </main>
</x-PDF-layout>
