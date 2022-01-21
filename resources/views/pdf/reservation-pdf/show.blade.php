<x-PDF-layout title="Detail Pemesanan">
    <main>
        <x-shared.content>
            <x-reservation-pdf.logo></x-reservation-pdf.logo>

            <section style="border-bottom: 1px dashed black"></section>

            <x-reservation-pdf.detail-info :reservation="$reservation" :nightCount="$nightCount">
            </x-reservation-pdf.detail-info>

            <section style="border-bottom: 1px dashed black"></section>

            <x-reservation-pdf.table-room :reservation="$reservation" :roomBillString="$roomBillString"
                :nightCount="$nightCount">
            </x-reservation-pdf.table-room>

            <x-reservation-pdf.table-service :reservation="$reservation" :serviceBillString="$serviceBillString"
                :nightCount="$nightCount">
            </x-reservation-pdf.table-service>

            <x-reservation-pdf.table-restaurant :reservation="$reservation"
                :restaurantBillString="$restaurantBillString">
            </x-reservation-pdf.table-restaurant>

            <section style="border-bottom: 1px dashed black"></section>

            <x-reservation-pdf.total-price :reservation="$reservation" :restOfBill="$restOfBill" :payment="$payment">
            </x-reservation-pdf.total-price>

            <x-reservation-pdf.note></x-reservation-pdf.note>
        </x-shared.content>
    </main>
</x-PDF-layout>
