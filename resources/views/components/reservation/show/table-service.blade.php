<x-shared.card title="Detail Layanan">
    <div class="row">
        <div class="col">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kuantitas</th>
                        <th>Nomor Kamar</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservation->serviceOrders as $serviceOrder)
                        <tr>
                            <td>{{ $serviceOrder->service->name }}</td>
                            <td>{{ $serviceOrder->quantity }}</td>
                            <td>
                                @foreach ($reservation->roomOrders as $roomOrder)
                                    <span class="badge badge-pill badge-warning">{{ $roomOrder->room->room_number }}
                                    </span>
                                @endforeach
                            </td>
                            <td>{{ $serviceOrder->price }} (x {{ $serviceOrder->quantity }} kamar x lama inap) </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-12 d-flex flex-column align-items-end text-secondary">
            Total Harga
            <p class="text-danger">{{ $totalServicePriceString ?? 0 }}</p>
        </div>
    </div>
</x-shared.card>
