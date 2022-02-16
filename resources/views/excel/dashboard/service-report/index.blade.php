<table>
    <thead>
        <tr>
            <th>Tanggal Pemesanan</th>
            <th>Nama Layanan</th>
            <th>Harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($serviceOrders as $serviceOrder)
            <tr>
                <td>{{ $serviceOrder->order_time }}</td>
                <td>{{ $serviceOrder->service->name }}</td>
                <td>{{ $serviceOrder->price }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2">Total</td>
            <td>{{ App\Traits\ServiceOrderTrait::getAllTotalPrice($serviceOrders) }}</td>
        </tr>
    </tbody>
</table>
