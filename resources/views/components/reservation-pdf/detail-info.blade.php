<x-reservation-pdf.logo :time="$reservation->reservation_time"></x-reservation-pdf.logo>

<section style="border-bottom: 1px dashed black"></section>

<br />

<section class="clearfix">
    <section class="float-left">
        <section>
            <strong>Pemesan</strong><br />
            {{ $reservation->guest->name }}
        </section>

        <section>
            <strong>Nomor HP</strong><br />
            {{ $reservation->guest->phone }}
        </section>
    </section>

    <section class="float-right text-right">
        <section>
            <strong>Status Pemesanan</strong><br />
            {{ $reservation->reservationStatus->name }}
        </section>

        <section>
            <strong>Telah Dikonfirmasi Oleh</strong><br />
            {{ $reservation->user->name ?? '-' }}
        </section>
    </section>
</section>

<section class="clearfix">
    <section class="float-left">
        <strong>No Order</strong><br />
        {{ $reservation->reservation_number }}
    </section>
</section>

<table>
    <thead>
        <tr>
            <th class="mr-5">Checkin</th>
            <th class="mr-5">Checkout</th>
            <th>Lama Inap</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="mr-5">{{ $reservation->check_in }}</td>
            <td class="mr-5">{{ $reservation->check_out }}</td>
            <td>{{ $nightCount }} Hari</td>
        </tr>
    </tbody>

</table>

<table>
    <thead>
        <tr>
            <th class="mr-4">Total Tamu</th>
            <th class="mr-4">Total Kamar</th>
            <th class="mr-4">Total Layanan</th>
            <th>Total Hidangan</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="mr-4">{{ $reservation->roomOrders->pluck('guest_count')->count() }}</td>
            <td class="mr-4">{{ $reservation->roomOrders->pluck('guest_count')->count() }}</td>
            <td class="mr-4">{{ $reservation->serviceOrders->pluck('quantity')->count() }}</td>
            <td>{{ $reservation->restaurantOrders->pluck('quantity')->count() }}</td>
        </tr>
    </tbody>
</table>
