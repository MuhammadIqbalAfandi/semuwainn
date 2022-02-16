<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <style>
        @font-face {
            font-family: 'open sans';
            src: url({{ asset('fonts/OpenSans-Regular.ttf') }}) format('truetype');
        }

        @font-face {
            font-family: 'open sans';
            src: url({{ asset('fonts/OpenSans-Italic.ttf') }}) format('truetype');
            font-style: italic, oblique;
        }

        @font-face {
            font-family: 'open sans';
            src: url({{ asset('fonts/OpenSans-Bold.ttf') }}) format('truetype');
            font-style: bold;
        }

        body {
            font-family: 'open Sans', serif;
        }

    </style>
</head>

<body>
    <main>
        <x-shared.content>
            <x-reservation-pdf.detail-info :reservation="$reservation" :nightCount="$nightCount">
            </x-reservation-pdf.detail-info>

            <br />
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

            <section style="border-bottom: 1px dashed black"></section><br />

            <x-reservation-pdf.total-price :reservation="$reservation" :restOfBill="$restOfBill" :payment="$payment">
            </x-reservation-pdf.total-price>

            <x-reservation-pdf.note></x-reservation-pdf.note>
        </x-shared.content>
    </main>
</body>

</html>
