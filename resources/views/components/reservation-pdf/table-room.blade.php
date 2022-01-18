@if ($reservation->roomOrders->count())
    <h3 class="h5 mt-4">Detail Ruangan</h3>

    <table class="table table-sm table-bordered mt-2">
        <thead>
            <tr class="font-weight-normal">
                <th>Nama</th>
                <th>Jumlah Tamu</th>
                <th>Jumlah Ruangan</th>
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
                    <td>{{ $roomOrder->quantity }}</td>
                    <td>
                        {{ $roomOrder->room->room_number }},
                    </td>
                    <td>{{ $roomOrder->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <section class="offset-auto text-right">
        <span class="text-secondary">Total Harga</span>
        <p class="text-danger">{{ $totalRoomPriceString ?? 0 }}</p>
    </section>
@endif
