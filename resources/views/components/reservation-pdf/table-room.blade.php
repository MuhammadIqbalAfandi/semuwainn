@if ($reservation->roomOrders->count())
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
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
                        <span class="badge badge-pill badge-warning">{{ $roomOrder->room->room_number }}</span>
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
