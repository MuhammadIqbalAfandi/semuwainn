@if ($reservation->roomOrders->count())
    <x-shared.card title="Detail Kamar">
        <div class="row">
            <div class="col">
                <table class="table table-sm table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jumlah Tamu</th>
                            <th>Nomor Kamar</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservation->roomOrders as $roomOrder)
                            <tr>
                                <td>
                                    <p>{{ $roomOrder->room->roomType->name }}</p>
                                </td>
                                <td>{{ $roomOrder->guest_count }}</td>
                                <td>
                                    <span
                                        class="badge badge-pill badge-warning">{{ $roomOrder->room->room_number }}</span>
                                </td>
                                <td>
                                    {{ $roomOrder->price }}
                                    <span class="text-sm text-secondary">
                                        (x {{ $nightCount }} Hari)
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
                <p class="text-danger">{{ $roomBillString ?? 0 }}</p>
            </div>
        </div>
    </x-shared.card>
@endif
