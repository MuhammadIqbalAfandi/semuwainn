@if ($reservation->serviceOrders->count())
    <x-shared.card title="Detail Layanan">
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
                        @foreach ($reservation->serviceOrders as $serviceOrder)
                            <tr>
                                <td>{{ $serviceOrder->service->name }}</td>
                                <td>{{ $serviceOrder->quantity }}</td>
                                <td>{{ $serviceOrder->updated_at }}</td>
                                <td>
                                    {{ $serviceOrder->price }}
                                    <span class="text-sm text-secondary">
                                        (x {{ $serviceOrder->quantity }} kamar x
                                        {{ $nightCount }} Hari)
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
                <p class="text-danger">{{ $serviceBillString ?? 0 }}</p>
            </div>
        </div>

        <x-reservation.show.table-service.modal-delete></x-reservation.show.table-service.modal-delete>
    </x-shared.card>
@endif
