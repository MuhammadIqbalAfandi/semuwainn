@if ($reservation->restaurantOrders->count())
    <h3 class="h5 mt-4">Detail Restaurant</h3>

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
            @foreach ($reservation->restaurantOrders as $restaurantOrder)
                <tr>
                    <td>{{ $restaurantOrder->restaurant->name }}</td>
                    <td>{{ $restaurantOrder->quantity }}</td>
                    <td>{{ $restaurantOrder->updated_at }}</td>
                    <td>
                        {{ $restaurantOrder->price }}
                        <span class="text-sm text-secondary">
                            (x {{ $restaurantOrder->quantity }} Kuantitas)
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <section class="offset-auto text-right">
        <span class="text-secondary">Total Harga</span>
        <p class="text-danger">{{ $restaurantBillString ?? 0 }}</p>
    </section>
@endif
