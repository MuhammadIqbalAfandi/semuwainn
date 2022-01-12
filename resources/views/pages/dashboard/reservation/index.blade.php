<x-dashboard-layout title="Daftar Pemesanan Kamar">
    <!-- Reservation List -->
    <x-shared.content-wrapper>
        <x-shared.content-header title="Daftar Pemesanan Kamar">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Daftar Pemesanan Kamar</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-shared.card title="Daftar Pemesanan Kamar">
                <div class="row">
                    <div class="col">
                        <table id="reservation-list-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        <span class="d-block">No. Order /</span>
                                        <span class="d-block">Tgl. Order</span>
                                    </th>
                                    <th>Tgl. Inap</th>
                                    <th>Lama Inap</th>
                                    <th>Jlh. Kamar</th>
                                    <th>Jumlah Tamu</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </x-shared.card>
        </x-shared.content>
    </x-shared.content-wrapper>

    <!-- Modal Edit Status -->
    <x-shared.modal title="Ubah Status Pemesanan" id="modal-edit-status">
        <form>
            <!-- Reservation Id -->
            <input type="hidden" name="reservation_id" id="reservation-id" value="{{ old('reservation-id') }}">

            <!-- Hak Akses -->
            <div class="form-group">
                <label for="reservation-status">Status Pemesanan</label>
                <select class="form-control" data-placeholder="Status Pemesanan" name="reservation_status"
                    id="reservation-status">
                    <option></option>
                </select>
            </div>

            <button type="submit" id="btn-edit-status" class="btn btn-block btn-warning">Simpan</button>
        </form>
    </x-shared.modal>

    <!-- Modal Delete -->
    <x-shared.modal id="modal-delete">
        <x-slot name="title">
            <i class="fa fa-exclamation-triangle text-danger"></i> Peringatan
        </x-slot>

        <p>Yakin akan menghapus data ini?</p>

        <x-slot name="footer">
            <form class="mr-1">

                <!-- Reservation Id -->
                <input type="hidden" name="reservation_id" id="reservation-id">
                <button type="submit" id="btn-delete" class="btn btn-warning float-right btn-rounded w-140">Ya</button>
            </form>
        </x-slot>
    </x-shared.modal>

    <!-- Modal Alert -->
    <x-shared.modal id="modal-alert">
        <x-slot name="title">
            <i class="fa fa-exclamation-triangle text-danger"></i> Peringatan
        </x-slot>

        <p>
            <span class="font-weight-bold">Opps!</span> <span id="text-alert"
                class="font-weight-bold text-warning"></span>
        </p>
    </x-shared.modal>

    <x-slot name="script">
        <script>
            $(() => {
                // Mounted
                // Library Configuration
                $('#reservation-list-table').DataTable({
                    stateSave: true,
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    autoWidth: false,
                    ajax: 'reservations/reservations',
                    columns: [{
                            data: 'order',
                            name: 'order',
                        },
                        {
                            data: 'checkin-checkout',
                            name: 'checkin-checkout',
                        },
                        {
                            data: 'night-count',
                            name: 'night-count',
                        },
                        {
                            data: 'room-count',
                            name: 'room-count',
                        },
                        {
                            data: 'guest-count',
                            name: 'guest-count',
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'actions',
                            name: 'actions'
                        }
                    ],
                    language: {
                        processing: '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...',
                        emptyTable: "Data tidak tersedia!",
                        zeroRecords: "Data tidak ditemukan",
                        search: "Cari:",
                    },
                })

                $('#reservation-status').select2({
                    theme: 'bootstrap4'
                })
                // End Library Configuration

                fetchReservation()

                // Edit Status
                $(document).on('click', '.btn-show-edit-status', function() {
                    const id = $(this).attr('id')

                    $.ajax({
                        dataType: 'json',
                        type: 'get',
                        url: `reservation-statuses/${id}/edit`,
                        beforeSend() {
                            $('#reservation-status').children('option').remove()
                            $('#modal-edit-status').modal('show')
                        },
                        success(res) {
                            if (res.reservationStatuses && res.reservationStatusId && res
                                .reservationId) {
                                res.reservationStatuses.forEach((reservationStatus) => {
                                    let newOption = new Option(
                                        reservationStatus.name,
                                        reservationStatus.id,
                                        false,
                                        reservationStatus.id === res.reservationStatusId,
                                    )
                                    $('#reservation-status').append(newOption)
                                })

                                $('#reservation-id').val(res.reservationId)
                            }
                        }
                    })
                })

                $('#btn-edit-status').click((e) => {
                    e.preventDefault()

                    const id = $('#reservation-id').val()
                    const reservationStatusId = $('#reservation-status').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'patch',
                        url: `reservations/${id}`,
                        data: {
                            id,
                            reservation_status_id: reservationStatusId
                        },
                        success(res) {
                            $('#modal-edit-status').modal('hide')
                            $('#reservation-status').val('')
                            $('#reservation-id').val('')

                            alert(res.message, res.status)
                            fetchReservation()
                        },
                        error(res) {
                            const {
                                message,
                                status
                            } = res.responseJSON
                            alert(message, status)
                            $('#modal-edit-status').modal('hide')
                        }
                    })
                })
                // End Edit Status
                // end Mounted

                // Methods
                function fetchRestaurant() {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'get',
                        url: 'restaurants/restaurants',
                        success(res) {
                            if (res.restaurants) {
                                $('#restaurant').children('option').remove()

                                res.restaurants.forEach(restaurant => {
                                    let newOption = new Option(restaurant.item_name, restaurant.id,
                                        false, false)
                                    $('#restaurant').append(newOption)
                                })
                            }
                        }
                    })
                }

                function fetchReservation() {
                    $('#reservation-list-table').DataTable().ajax.reload()
                }
                // end Methods
            })
        </script>
    </x-slot>
</x-dashboard-layout>
