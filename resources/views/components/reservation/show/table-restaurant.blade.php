@if ($reservation->restaurantOrders->count())
    <x-shared.card title="Detail Hidangan">
        <div class="row">
            <div class="col">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kuantitas</th>
                            <th>Tanggal Ditambahkan</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservation->restaurantOrders as $restaurantOrder)
                            <tr>
                                <td>{{ $restaurantOrder->restaurant->name }}</td>
                                <td>{{ $restaurantOrder->quantity }}</td>
                                <td>{{ $restaurantOrder->updated_at }}</td>
                                <td>{{ $restaurantOrder->price }} (x {{ $restaurantOrder->quantity }} Kuantitas)
                                </td>
                                <td>
                                    <i class="fas fa-trash-alt show-restaurant-delete-btn text-danger"
                                        id="{{ $restaurantOrder->id }}">
                                    </i>
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
                <p class="text-danger">{{ $totalRestaurantPriceString ?? 0 }}</p>
            </div>
        </div>

        <x-reservation.show.table-restaurant.modal-delete></x-reservation.show.table-restaurant.modal-delete>
    </x-shared.card>
@endif
