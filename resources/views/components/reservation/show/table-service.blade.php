@if ($reservation->serviceOrders->count())
    <x-shared.card title="Detail Layanan">
        <div class="row">
            <div class="col">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kuantitas</th>
                            <th>Nomor Kamar</th>
                            <th>Tanggal Ditambahkan</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservation->serviceOrders as $serviceOrder)
                            <tr>
                                <td>{{ $serviceOrder->service->name }}</td>
                                <td>{{ $serviceOrder->quantity }}</td>
                                <td>
                                    @foreach ($reservation->roomOrders as $roomOrder)
                                        <span
                                            class="badge badge-pill badge-warning">{{ $roomOrder->room->room_number }}
                                        </span>
                                    @endforeach
                                </td>
                                <td>{{ $serviceOrder->updated_at }}</td>
                                <td>{{ $serviceOrder->price }} (x {{ $serviceOrder->quantity }} kamar x lama inap)
                                </td>
                                <td>
                                    <i class="fas fa-trash-alt show-service-delete-btn text-danger"
                                        id="{{ $serviceOrder->id }}">
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
                <p class="text-danger">{{ $totalServicePriceString ?? 0 }}</p>
            </div>
        </div>

        <x-reservation.show.table-service.modal-delete></x-reservation.show.table-service.modal-delete>
    </x-shared.card>
@endif
