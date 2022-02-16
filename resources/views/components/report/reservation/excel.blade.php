<table>
    <thead>
        <tr>
            <th>Tanggal Pemesanan</th>
            <th>Jenis Ruangan</th>
            <th>Tanggal Kedatangan</th>
            <th>Tanggal Keberangkatan</th>
            <th>Lama Inap</th>
            <th>Jumlah Tamu</th>
            <th>Harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roomOrders as $roomOrder)
            <tr>
                <td>{{ $roomOrder->order_time }}</td>
                <td>{{ $roomOrder->room->roomType->name }}</td>
                <td>{{ $roomOrder->reservation->check_in }}</td>
                <td>{{ $roomOrder->reservation->checkout }}</td>
                <td>{{ $roomOrder->getNightCount() }}</td>
                <td>{{ $roomOrder->guest_count }}</td>
                <td>{{ $roomOrder->price }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5">Total</td>
            <td>{{ $roomOrder->sum('guest_count') }}</td>
            <td>{{ App\Models\RoomOrder::getAllTotalPrice($roomOrders) }}</td>
        </tr>
    </tbody>
</table>
