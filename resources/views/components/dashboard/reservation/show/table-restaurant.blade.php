@props(['reservation', 'restaurantBillString'])

@if ($reservation->restaurantOrders->count())
    <x-shared.card title="Detail Hidangan">
        <div class="row">
            <div class="col">
                <table class="table table-sm table-bordered table-hover">
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
            </div>
        </div>

        <div class="row">
            <div class="col-12 d-flex flex-column align-items-end text-secondary">
                Total Harga
                <p class="text-danger">{{ $restaurantBillString ?? 0 }}</p>
            </div>
        </div>
    </x-shared.card>
@endif
