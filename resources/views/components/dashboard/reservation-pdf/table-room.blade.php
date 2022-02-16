@props(['reservation', 'roomBillString', 'nightCount'])

@if ($reservation->roomOrders->count())
    <strong>Detail Ruangan</strong><br />

    <table class="table table-sm table-striped mt-2">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jumlah Tamu</th>
                <th>Nomor Kamar</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservation->roomOrders as $roomOrder)
                <tr>
                    <td>
                        <p>{{ $roomOrder->room->roomType->name }}</p>
                    </td>
                    <td>{{ $roomOrder->guest_count }}</td>
                    <td>
                        {{ $roomOrder->room->room_number }}
                    </td>
                    <td>
                        {{ $roomOrder->price }}
                        <span class="text-sm text-secondary">
                            (x {{ $nightCount }} Hari)
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <section class="offset-auto text-right">
        <strong>Total Harga</strong><br />
        {{ $roomBillString ?? 0 }}
    </section>
@endif
