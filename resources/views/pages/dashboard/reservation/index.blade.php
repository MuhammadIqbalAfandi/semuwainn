<x-dashboard-layout title="Daftar Pemesanan Kamar">
    <!-- Reservation List -->
    <x-shared.content-wrapper>
        <x-shared.content-header title="Daftar Pemesanan Kamar">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-warning">Dashboard</a>
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
                                    <th>Tamu</th>
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
                </select>
            </div>

            <button type="submit" id="btn-edit-status" class="btn btn-block btn-warning">Simpan</button>
        </form>
    </x-shared.modal>

    <!-- Modal Edit -->
    <x-shared.modal title="Edit Pemesanan" id="modal-edit">
        <form>
            <!-- Reservation Id -->
            <input type="hidden" name="reservation_id" id="reservation-id" value="{{ old('reservation-id') }}">

            <div class="row">
                <!-- Guest -->
                <div class="col">
                    <div class="form-group">
                        <label for="guest-nik">NIK</label>
                        <select data-width="100%" value="{{ old('guest-nik') }}" name="guest_id" id="guest-nik"
                            class="form-control">
                            <option></option>
                        </select>

                        <span class="guest_id-error msg-error text-danger"></span>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="guest-name">Nama</label>
                        <input type="text" class="form-control" id="guest-name" readonly>
                    </div>
                </div>
            </div>

            <!-- Date checkin -->
            <div class="form-group">
                <label for="checkin">Tanggal Kedatangan</label>
                <div class="input-group date" id="checkindate" data-target-input="nearest">
                    <input type="text" name="checkin" id="checkin" value="{{ old('checkin') }}"
                        placeholder="Tanggal Kedatangan" class="form-control datetimepicker-input"
                        data-target="#checkindate" />
                    <div class="input-group-append" data-target="#checkindate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>

                <span class="checkin-error msg-error text-danger"></span>
            </div>

            <!-- Date checkout -->
            <div class="form-group">
                <label for="checkin">Tanggal Keberangkatan</label>
                <div class="input-group date" id="checkoutdate" data-target-input="nearest">
                    <input type="text" name="checkout" id="checkout" value="{{ old('checkout') }}"
                        placeholder="Tanggal keberakatan" class="form-control datetimepicker-input"
                        data-target="#checkoutdate" />
                    <div class="input-group-append" data-target="#checkoutdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>

                <span class="checkout-error msg-error text-danger"></span>
            </div>

            <div class="row">
                <div class="col">
                    <!-- Parent -->
                    <div class="form-group">
                        <label for="adult">Dewasa</label>
                        <input class="form-control" name="adult" id="adult" type="text" value="{{ old('adult') }}"
                            placeholder="Jumlah dewasa" />

                        <span class="adult-error msg-error text-danger"></span>
                    </div>
                </div>

                <div class="col">
                    <!-- Children -->
                    <div class="form-group">
                        <label for="children">Anak-anak </label>
                        <input class="form-control" name="children" id="children" type="text"
                            value="{{ old('children') }}" placeholder="Jumlah anak-anak" />

                        <span class="children-error msg-error text-danger"></span>
                    </div>
                </div>
            </div>

            <button id="btn-edit" type="submit" class="btn btn-block btn-warning">Simpan</button>
        </form>
    </x-shared.modal>

    <!-- Modal Add Room -->
    <x-shared.modal title="Tambah Kamar" id="modal-add-room" size="modal-xl">
        <form id="reservation-form">
            <!-- Reservation Id -->
            <input type="hidden" name="reservation_id" id="reservation-id" value="{{ old('reservation-id') }}">

            <div class="row">
                <div class="col-lg">
                    <!-- Room Type -->
                    <div class="form-group">
                        <label for="room">Kamar</label>
                        <select data-width="100%" name="room" id="room" class="form-control">
                            <option></option>
                        </select>
                    </div>
                </div>

                <div class="col-lg">
                    <!-- Price -->
                    <div class="form-group">
                        <label>Harga Kamar</label>
                        <select data-width="100%" name="price" id="price" class="form-control">
                            <option></option>
                        </select>
                    </div>
                </div>

                <div class="col-lg">
                    <!-- Disc -->
                    <div class="form-group">
                        <label>Diskon kamar</label>
                        <input class="form-control" name="disc" id="disc" type="text" />
                    </div>
                </div>

                <div class="col-lg-1 d-flex align-items-center justify-content-end mt-3">
                    <button type="button" class="btn btn-sm btn-warning" id="btn-detail-room"><i
                            class="fa fa-plus"></i></button>
                </div>
            </div>

            <div class="row my-5">
                <div class="col">
                    <!-- Room list -->
                    <table id="room-detail-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tipe Kamar</th>
                                <th>No. Kamar</th>
                                <th>Harga</th>
                                <th>Diskon %</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="row">
                <button type="submit" id="btn-add-room" class="btn btn-sm btn-warning ml-auto">Simpan</button>
            </div>
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
                 // Data
                    let State = {
                        initialRooms: [],
                        rooms: '',
                        prices: '',
                        listOfRoomBooked: [],
                        run() {
                            State.setProperty()
                            State.setRooms()
                            State.setPrices()
                        },
                        setProperty(key, value) {
                           this[key] = value
                        },
                        setRooms(key, value) {
                            this[key] = value
                            if (State[key]) {
                                $('#room').children('option:not(:first)').remove()
                                State[key].sort((a, b) => a.room_number - b.room_number)
                                State[key].forEach((room) => {
                                    let newOption = new Option(room.room_number, room.id, false, false)
                                    $('#room').append(newOption)
                                })
                            }
                        },
                        setPrices(key, value) {
                            this[key] = value
                            if (State[key]) {
                                $('#price').children('option:not(:first)').remove()
                                State[key].sort((a, b) => a.price - b.price)
                                State[key].forEach((price) => {
                                    let newOption = new Option(price.price, price.id, false, false)
                                    $('#price').append(newOption)
                                })
                            }
                        }
                    }
                // end Data

                // Mounted
                // Library Configuration
                const reservationsTable = $('#reservation-list-table').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": false,
                })

                const roomDetailTable = $('#room-detail-table').DataTable({
                    "paging": false,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": false,
                    "info": false,
                    "autoWidth": true,
                    "responsive": false,
                })

                $('#service').select2({
                    theme: 'bootstrap4',
                })

                $('#restaurant').select2({
                    theme: 'bootstrap4',
                })

                $("#room").select2({
                    placeholder: 'Pilih kamar',
                    theme: 'bootstrap4',
                    allowClear: true
                })

                $("#price").select2({
                    placeholder: 'Pilih harga kamar',
                    theme: 'bootstrap4',
                    allowClear: true
                })

                $('#guest-nik').select2({
                    minimumInputLength: 5,
                    theme: 'bootstrap4',
                    allowClear: true,
                    placeholder: 'Tuliskan NIK',
                    ajax: {
                        url: "/dashboard/reservation/nik",
                        dataType: 'json',
                        delay: 250,
                        cache: true,
                        data(param) {
                            return {
                                search: param.term
                            }
                        },
                        processResults(res) {
                            return {
                                results: res.map((item) => ({
                                    id: item.id,
                                    text: item.nik,
                                })),
                            }
                        }
                    },
                    language: {
                        noResults() {
                        return `
                            <button class="btn btn-block btn-warning" data-toggle="modal" data-target="#modal-add-guest">
                                <i class="fa fa-plus"></i>
                                Tamu Baru
                            </button>
                        `
                        }
                    },
                    escapeMarkup(markup) {
                        return markup;
                    },
                })

                $('#checkindate').datetimepicker({
                    format: 'L',
                    locale: 'id',
                })
                $('#checkoutdate').datetimepicker({
                    format: 'L',
                    locale: 'id',
                    useCurrent: false,
                })
                $("#checkindate").on("change.datetimepicker", function (e) {
                    $('#checkoutdate').datetimepicker('minDate', e.date)
                })
                // End Library Configuration

                State.run()
                fetchReservation()

                // Add Room
                $(document).on('click', '.btn-show-add-room', function() {
                    const id = $(this).attr('id')
                    $('#reservation-id').val(id)

                    State.listOfRoomBooked.length = 0
                    roomDetailTable.clear().draw()

                    validateReservationForm()
                    fetchRooms()
                    $('#btn-add-room').hide()
                    $('#modal-add-room').modal('show')
                })

                $('#room').change((e) => {
                    let rooms = State.rooms.filter((room) => room.id == e.target.value)
                    for (room of rooms) {
                        State.setPrices('prices', room.room_type.room_prices)
                    }
                })

                $('#btn-detail-room').click(() => {
                    const reservationForm = $('#reservation-form')
                    const room = $('#room').val()
                    const price = $('#price').val()
                    let discount = $('#disc').val()
                    const btnDeleteDetailRoom = `
                        <button type="button" class="btn btn-delete-detail-room text-danger"
                            data-toggle="modal" data-target="#block-modal">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    `

                    if (discount.length > 1) {
                        discount = discount.replace(/^0+/, '')
                    }
                    if (!discount.length) {
                        discount = 0
                    }

                    if (!reservationForm.valid()) {
                        return false
                    }

                    if (room && price) {
                        let newRoom = State.rooms.filter((value) => value.id == room)
                        let newPrice = newRoom[0].room_type.room_prices.filter(roomPrice => roomPrice.id == price)
                        let discountedPrice = newPrice[0].price - (newPrice[0].price * discount / 100)

                        roomDetailTable.row.add([
                            newRoom[0].room_type.room_type_name,
                            newRoom[0].room_number,
                            idMoneyFormat(newPrice[0].price),
                            discount,
                            idMoneyFormat(discountedPrice),
                            btnDeleteDetailRoom
                        ]).draw(false)

                        State.listOfRoomBooked.push({
                            room,
                            price: newPrice[0].price,
                            discount,
                            room_number: newRoom[0].room_number
                        })
                        if (State.listOfRoomBooked.length) {
                            $('#btn-add-room').show()
                        }

                        const rooms = State.rooms.filter(value => value.id != room)
                        State.setRooms('rooms', rooms)

                        clearPriceForm()
                    } else {
                        $('#text-alert').text('Pilih kamar dan harga terlebih dahulu')
                        $('#modal-alert').modal('show')
                    }
                })

                $(document).on('click', '.btn-delete-detail-room', function () {
                    const roomNumber = roomDetailTable.row($(this).closest('tr')).data()[1]

                    const newRoom = State.initialRooms.filter(room => room.room_number == roomNumber)
                    State.rooms.push(newRoom[0])
                    State.setRooms('rooms', State.rooms)

                    const listOfRoomBooked =  State.listOfRoomBooked.filter(roomBooked => roomBooked.room_number != roomNumber)
                    State.setProperty('listOfRoomBooked', listOfRoomBooked)
                    if (!State.listOfRoomBooked.length) {
                        $('#btn-add-room').hide()
                    }

                    roomDetailTable.row($(this).parents('tr')).remove().draw()
                })

                $('#btn-add-room').click((e) => {
                    e.preventDefault()

                    const id = $('#reservation-id').val()

                    const discounts = []
                    const rooms = []
                    const prices = []
                    State.listOfRoomBooked.forEach(roomBooked => {
                        discounts.push(roomBooked.discount)
                        rooms.push(roomBooked.room)
                        prices.push(roomBooked.price)
                    })

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'post',
                        url: `/dashboard/reservation/room/${id}`,
                        data: {
                            discounts,
                            rooms,
                            prices
                         },
                         success(res) {
                            clearPriceForm()
                            roomDetailTable.clear().draw()
                            State.listOfRoomBooked.length = 0
                            $('#reservation-id').val('')

                            alert(res.message, res.status)
                            $('#modal-add-room').modal('hide')
                            fetchReservation()
                         },
                         error(res) {
                             if (res.status === 400) {
                                alert(res.responseJSON.message, res.responseJSON.status)
                                $('#modal-add-room').modal('hide')
                             }
                         }
                    })
                })
                // End Add Room

                // Edit Status
                $(document).on('click', '.btn-show-edit-status', function() {
                    const id = $(this).attr('id')

                    $.ajax({
                        dataType: 'json',
                        type: 'get',
                        url: `/dashboard/reservation/status/${id}/edit`,
                        beforeSend() {
                            $('#reservation-status').children('option').remove()
                            $('#modal-edit-status').modal('show')
                        },
                        success(res) {
                            if (res.reservation && res.reservationStatuses) {
                                res.reservationStatuses.forEach(reservationStatus => {
                                    let newOption = new Option(
                                        reservationStatus.reservation_status_name,
                                        reservationStatus.id,
                                        false,
                                        res.reservation.reservation_status_id === reservationStatus.id
                                    )
                                    $('#reservation-status').append(newOption)

                                    $('#reservation-id').val(res.reservation.id)
                                })
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
                        url: `/dashboard/reservation/status/${id}`,
                        data: {
                            id,
                            reservation_status_id: reservationStatusId,
                        },
                        success(res) {
                            $('#modal-edit-status').modal('hide')
                            $('#reservation-status').val('')
                            $('#reservation-id').val('')

                            alert(res.message, res.status)
                            fetchReservation()
                        },
                    })
                })
                // End Edit Status

                // Edit Reservation
                $(document).on('click', '.btn-show-edit', function() {
                    const id = $(this).attr('id')

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'get',
                        url: `/dashboard/reservation/${id}/edit`,
                        beforeSend() {
                            $('.msg-error').text('')
                            $('#modal-edit').modal('show')
                        },
                        success(res) {
                            if (res.reservation) {
                                const guestId = res.reservation.guest.id
                                const guestNik = res.reservation.guest.nik
                                const guestName = res.reservation.guest.name
                                const arrivalDate = res.reservation.room_orders[0].arrival_date
                                const departureDate = res.reservation.room_orders[0].departure_date
                                const adult = res.reservation.adult
                                const children = res.reservation.children

                                let option = new Option(guestNik, guestId, true, true)
                                $('#guest-nik').append(option).trigger('change')

                                $('#reservation-id').val(res.reservation.id)
                                $('#guest-name').val(guestName)
                                $('#checkindate').datetimepicker('date', moment(arrivalDate, 'DD-MM-YYYY'))
                                $('#checkoutdate').datetimepicker('date', moment(departureDate, 'DD-MM-YYYY'))
                                $('#adult').val(adult)
                                $('#children').val(children)
                            }
                        }
                    })
                })

                $('#guest-nik').change((e) => {
                    const guestId = e.target.value

                    $.ajax({
                        dataType: 'json',
                        type: 'get',
                        url: `/dashboard/guest/${guestId}`,
                        success(res) {
                            if (res.guest) {
                                $('#guest-name').val(res.guest.name)
                            }
                        }
                    })
                })

                $('#btn-edit').click((e) => {
                    e.preventDefault()

                    const id = $('#reservation-id').val()
                    const guestId = $('#guest-nik').val()
                    const checkin = $('#checkin').val()
                    const checkout = $('#checkout').val()
                    const adult = $('#adult').val()
                    const children = $('#children').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'patch',
                        url: `/dashboard/reservation/${id}`,
                        data: {
                            guest_id: guestId,
                            checkin,
                            checkout,
                            adult,
                            children,
                        },
                        success(res) {
                            $('#modal-edit').modal('hide')
                            $('#reservation-id').val('')

                            alert(res.message, res.status)
                            fetchReservation()
                        },
                        error(res) {
                            if (res.status === 400) {
                                alert(res.responseJSON.message, res.responseJSON.status)
                                $('#modal-edit').modal('hide')
                            }

                            const errors = res.responseJSON.errors
                            for (const key in errors) {
                                $(`.${key}-error`).text(errors[key])
                            }
                        }
                    })
                })
                // End Edit Reservation

                // Delete Reservation
                $(document).on('click', '.btn-show-delete', function() {
                    const id = $(this).attr('id')
                    $('#reservation-id').val(id)
                    $('#modal-delete').modal('show')
                })

                $('#btn-delete').click((e) => {
                    e.preventDefault()

                    const id = $('#reservation-id').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'delete',
                        url: `/dashboard/reservation/${id}`,
                        success(res) {
                            $('#modal-delete').modal('hide')
                            $('#reservation-id').val('')

                            alert(res.message, res.status)
                            fetchReservation()
                        },
                    })
                })
                // End Delete Reservation
                // end Mounted

                // Methods
                function clearPriceForm() {
                    $('#price').children('option:not(:first)').remove()
                    $('#disc').val('')
                }

                function fetchRestaurant() {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'get',
                        url: 'restaurant/restaurants',
                        success(res) {
                            if (res.restaurants) {
                                $('#restaurant').children('option').remove()

                                 res.restaurants.forEach(restaurant => {
                                    let newOption = new Option(restaurant.item_name, restaurant.id, false, false)
                                    $('#restaurant').append(newOption)
                                })
                            }
                        }
                    })
                }

                function fetchReservation() {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'get',
                        url: '/dashboard/reservation/reservations',
                        success(res) {
                            if (res.reservations) {
                                reservationsTable.clear().draw()

                                res.reservations.forEach((reservation) => {
                                    let roomOrder = reservation.room_orders[0]
                                    let reservedDate = reservation.reserved_date
                                    let arrivalDate = roomOrder.arrival_date
                                    let departureDate = roomOrder.departure_date
                                    let roomCount = reservation.room_orders.length
                                    let guestName = reservation.guest.name
                                    let guestPhone = reservation.guest.phone
                                    let reservationStatusName = reservation.reservation_status.reservation_status_name

                                    let date1 = moment(arrivalDate, 'DD-MM-YYYY')
                                    let date2 = moment(departureDate, 'DD-MM-YYYY')
                                    let daysDifferent = date2.diff(date1, 'days')

                                    reservationsTable.row.add([
                                        `
                                            <span class="d-block">${reservation.reservation_number}</span>
                                            <span class="d-block text-secondary">${reservedDate}</span>
                                        `,
                                        `
                                            <p>
                                                <span class="d-block text-secondary">Kedatangan:</span>
                                                <span class="d-block">${arrivalDate}</span>
                                            </p>
                                            <p>
                                                <span class="d-block text-secondary">Keberangkatan:</span>
                                                <span class="d-block">${departureDate}</span>
                                            </p>
                                        `,
                                        `
                                            <p>${daysDifferent} Hari</p>
                                        `,
                                        roomCount,
                                        `
                                            <span class="d-block">${guestName}</span>
                                            <span class="d-block text-secondary">${guestPhone}</span>
                                        `,
                                        `
                                        <span class="d-block ${reservationStatusName === 'Dipesan' ? '' : 'text-secondary'}">Dipesan</span>
                                        <span class="d-block ${reservationStatusName === 'Dibayar' ? '' : 'text-secondary'}">Dibayar</span>
                                            <span class="d-block ${reservationStatusName === 'Dibatalkan' ? '' : 'text-secondary'}">Dibatalkan</span>
                                        `,
                                        `
                                            <div class="btn-group">
                                                <button class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown">
                                                    Pilih
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li id="${reservation.id}" class="dropdown-item btn-show-edit-status">Ubah Status</li>
                                                    <li id="${reservation.id}" class="dropdown-item btn-show-add-room" >Tambah Kamar</li>
                                                    <li id="${reservation.id}" class="dropdown-item btn-show-add-service">Tambah Layanan</li>
                                                    <li id="${reservation.id}" class="dropdown-item btn-show-add-restaurant">Tambah Hidangan</li>
                                                    <li class="dropdown-item">Cetak Invoice</li>
                                                    <li id="${reservation.id}" class="dropdown-item btn-show-edit">Ubah Pemesanan</li>
                                                    <li id="${reservation.id}" class="dropdown-item btn-show-delete">Hapus</li>
                                                </ul>
                                            </div>
                                        `
                                    ]).draw(false)
                                })
                            }
                        }
                    })
                }

                function validateReservationForm() {
                    $('#reservation-form').validate({
                        rules: {
                            disc: {
                                number: true,
                                min: 0,
                                max: 100
                            }
                        },
                        errorElement: "span",
                        errorPlacement(error, element) {
                            error.addClass('msg-error text-danger')
                            element.closest('.form-group').append(error)
                        }
                    })
                }

                function fetchRooms() {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'get',
                        url: '/dashboard/reservation/rooms',
                        success(res) {
                            if (res.rooms) {
                                State.setRooms('rooms', res.rooms)
                                State.setProperty('initialRooms', res.rooms)
                            }
                        }
                    })
                }
                // end Methods
            })
        </script>
    </x-slot>
</x-dashboard-layout>
