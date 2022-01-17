@if ($reservation->restaurantOrders->count())
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kuantitas</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservation->restaurantOrders as $restaurantOrder)
                <tr>
                    <td>{{ $restaurantOrder->restaurant->name }}</td>
                    <td>{{ $restaurantOrder->quantity }}</td>
                    <td>{{ $restaurantOrder->price }} (x {{ $restaurantOrder->quantity }} Kuantitas)</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <section class="offset-auto text-right">
        <span class="text-secondary">Total Harga</span>
        <p class="text-danger">{{ $totalRestaurantPriceString ?? 0 }}</p>
    </section>
@endif
