@if ($reservation->serviceOrders->count())
    <h3 class="h5 mt-4">Detail Layanan</h3>

    <table class="table table-sm table-bordered mt-2">
        <thead>
            <tr class="font-weight-normal">
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
        <span class="text-secondary">Total Harga</span>
        <p class="text-danger">{{ $serviceBillString ?? 0 }}</p>
    </section>
@endif
