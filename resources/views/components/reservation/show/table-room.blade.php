<x-shared.card title="Detail Kamar">
    <div class="row">
        <div class="col">
            <table class="table table-bordered table-hover">
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
        </div>
    </div>

    <div class="row">
        <div class="col-12 d-flex flex-column align-items-end text-secondary">
            Total Harga
            <p class="text-danger">{{ $totalRoomPriceString ?? 0 }}</p>
        </div>
    </div>
</x-shared.card>
