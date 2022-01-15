@prepend('css')
    <style>
        table.minimalistBlack {
            border: 3px solid #000000;
            width: 100%;
            text-align: left;
            border-collapse: collapse;
        }

        table.minimalistBlack td,
        table.minimalistBlack th {
            border: 1px solid #000000;
            padding: 5px 4px;
        }

        table.minimalistBlack tbody td {
            font-size: 13px;
        }

        table.minimalistBlack thead {
            background: #CFCFCF;
            background: -moz-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
            background: -webkit-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
            background: linear-gradient(to bottom, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
            border-bottom: 3px solid #000000;
        }

        table.minimalistBlack thead th {
            font-size: 15px;
            font-weight: bold;
            color: #000000;
            text-align: left;
        }

        table.minimalistBlack tfoot {
            font-size: 14px;
            font-weight: bold;
            color: #000000;
            border-top: 3px solid #000000;
        }

        table.minimalistBlack tfoot td {
            font-size: 14px;
        }

        .total-price p,
        .total-price h3 {
            color: red;
        }

    </style>
@endprepend

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
