<table class="minimalistBlack">
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

<section class="total-price">
    <section>
        Total Harga
        <p>{{ $totalRoomPriceString ?? 0 }}</p>
    </section>
</section>
