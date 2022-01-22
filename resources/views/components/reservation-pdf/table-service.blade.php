@if ($reservation->serviceOrders->count())
    <strong>Detail Layanan</strong><br />

    <table class="table table-sm table-striped mt-2">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kuantitas</th>
                <th>Tanggal Ditambahkan</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservation->serviceOrders as $serviceOrder)
                <tr>
                    <td>{{ $serviceOrder->service->name }}</td>
                    <td>{{ $serviceOrder->quantity }}</td>
                    <td>{{ $serviceOrder->updated_at }}</td>
                    <td>
                        {{ $serviceOrder->price }}
                        <span class="text-sm text-secondary">
                            (x {{ $serviceOrder->quantity }} kamar x
                            {{ $nightCount }} Hari)
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <section class="offset-auto text-right">
        <strong>Total Harga</strong><br />
        {{ $serviceBillString ?? 0 }}
    </section>
@endif
