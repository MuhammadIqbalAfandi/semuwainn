@props(['reservation', 'restaurantBillString'])

@if ($reservation->restaurantOrders->count())
    <strong>Detail Restaurant</strong><br />

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
        <strong>Total Harga</strong><br />
        {{ $restaurantBillString ?? 0 }}
    </section>
@endif
