<table>
    <thead>
        <tr>
            <th>Tanggal Pemesanan</th>
            <th>Hidangan dipesan</th>
            <th>Kuantitas</th>
            <th>Harga Perporsi</th>
            <th>Total Harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($restaurantOrders as $restaurantOrder)
            <tr>
                <td>{{ $restaurantOrder->order_time }}</td>
                <td>{{ $restaurantOrder->restaurant->name }}</td>
                <td>{{ $restaurantOrder->quantity }}</td>
                <td>{{ $restaurantOrder->price }}</td>
                <td>{{ $restaurantOrder->totalPrice() }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2">Total</td>
            <td>{{ $restaurantOrders->sum('quantity') }}</td>
            <td></td>
            <td>{{ $restaurantOrder->getAllTotalPrice($restaurantOrders) }}</td>
        </tr>
    </tbody>
</table>
