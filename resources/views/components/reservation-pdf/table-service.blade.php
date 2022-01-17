@if ($reservation->serviceOrders->count())
    <table class="table table-bordered table-striped">
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

    <section class="offset-auto text-right">
        <span class="text-secondary">Total Harga</span>
        <p class="text-danger">{{ $totalServicePriceString ?? 0 }}</p>
    </section>
@endif
