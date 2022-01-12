<x-shared.card title="Detail Hidangan">
    <div class="row">
        <div class="col">
            <table class="table table-bordered table-hover">
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
        </div>
    </div>

    <div class="row">
        <div class="col-12 d-flex flex-column align-items-end">
            <p>Total Harga</p>
            <p>{{ $totalRestaurantPriceString ?? 0 }}</p>
        </div>
    </div>
</x-shared.card>
