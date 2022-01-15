<table class="minimalistBlack">
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

<section class="total-price">
    <section>
        Total Harga
        <p>{{ $totalRestaurantPriceString ?? 0 }}</p>
    </section>
</section>
