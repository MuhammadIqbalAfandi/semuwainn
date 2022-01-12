<x-dashboard-layout title="Pemesanan Kamar">
    <!-- Reservation Add -->
    <x-shared.content-wrapper id="pemesanan-kamar">
        <x-shared.content-header title="Tambah Pemesanan Kamar">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Tambah Pemesanan</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-shared.card title="Form Data Pemesanan">
                <form id="reservation-form">
                    <div class="row">
                        <!-- Guest -->
                        <div class="col-lg col-md-12">
                            <div class="form-group">
                                <label for="guest-nik">NIK</label>
                                <select data-width="100%" value="{{ old('guest-nik') }}" name="guest_id"
                                    id="guest-nik" class="form-control">
                                    <option></option>
                                </select>

                                <span class="guest_id-error msg-error text-danger"></span>
                            </div>
                        </div>

                        <div class="col-lg col-md-12">
                            <div class="row">
                                <div class="col-lg">
                                    <!-- Date checkin -->
                                    <div class="form-group">
                                        <label for="checkin">Tanggal Kedatangan</label>
                                        <div class="input-group date" id="checkindate" data-target-input="nearest">
                                            <input type="text" name="checkin" id="checkin"
                                                value="{{ old('checkin') }}" placeholder="Tanggal kedatangan"
                                                class="form-control datetimepicker-input" data-target="#checkindate" />
                                            <div class="input-group-append" data-target="#checkindate"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>

                                        <span class="checkin-error msg-error text-danger"></span>
                                    </div>
                                </div>

                                <div class="col-lg">
                                    <!-- Date checkout -->
                                    <div class="form-group">
                                        <label for="checkin">Tanggal Keberangkatan</label>
                                        <div class="input-group date" id="checkoutdate" data-target-input="nearest">
                                            <input type="text" name="checkout" id="checkout"
                                                value="{{ old('checkout') }}" placeholder="Tanggal keberakatan"
                                                class="form-control datetimepicker-input" data-target="#checkoutdate" />
                                            <div class="input-group-append" data-target="#checkoutdate"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>

                                        <span class="checkout-error msg-error text-danger"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg">
                            <div class="row">
                                <div class="col-lg">
                                    <!-- Parent -->
                                    <div class="form-group">
                                        <label for="adult">Dewasa</label>
                                        <input class="form-control" name="adult" id="adult" type="text"
                                            value="{{ old('adult') }}" placeholder="Jumlah dewasa" />

                                        <span class="adult-error msg-error text-danger"></span>
                                    </div>
                                </div>

                                <div class="col-lg">
                                    <!-- Children -->
                                    <div class="form-group">
                                        <label for="children">Anak-anak </label>
                                        <input class="form-control" name="children" id="children" type="text"
                                            value="{{ old('children') }}" placeholder="Jumlah anak-anak" />

                                        <span class="children-error msg-error text-danger"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-bold"><i class="fas fa-percent"></i></span>
                                    </div>
                                    <input class="form-control" name="disc" id="disc" type="text" />
                                </div>
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

                    <div class="row my-5">
                        <button type="submit" id="btn-save" class="btn btn-sm btn-warning ml-auto">Simpan</button>
                    </div>
                </form>
            </x-shared.card>
        </x-shared.content>
    </x-shared.content-wrapper>

    <!-- Modal Add Guest -->
    <x-shared.modal title="Tambah Akun user" id="modal-add-guest">
        <form>
            <!-- Nik -->
            <div class="form-group">
                <label for="nik-add">Nik</label>
                <input type="text" name="nik" id="nik-add" value="{{ old('nik') }}" class="form-control"
                    placeholder="Tulis nik disini">

                <span class="nik-add-error msg-error text-danger"></span>
            </div>

            <!-- Name -->
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" id="name-add" value="{{ old('name') }}" class="form-control"
                    placeholder="Tulis nama disini">

                <span class="name-add-error msg-error text-danger"></span>
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label for="phone">Nomor HP</label>
                <input type="tel" pattern="[0-9]*" id="phone-add" name="phone" value="{{ old('phone') }}"
                    class="form-control" placeholder="Tulis nomor hp disini">

                <span class="phone-add-error msg-error text-danger"></span>
            </div>

            <!-- Address -->
            <div class="form-group">
                <label for="address">Alamat</label>
                <input type="address" name="address" id="address-add" value="{{ old('address') }}"
                    class="form-control" placeholder="Tulis alamat disini">

                <span class="address-add-error msg-error text-danger"></span>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email-add" value="{{ old('email') }}" class="form-control"
                    placeholder="Tulis email disini">

                <span class="email-add-error msg-error text-danger"></span>
            </div>

            <button type="submit" id="btn-add-guest" class="btn btn-block btn-warning">Simpan</button>
        </form>
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
                                    text: item.nik
                                })),
                            }
                        },
                    },
                    language: {
                        noResults() {
                            return `
                            <button class="btn btn-block btn-warning" data-toggle="modal" data-target="#modal-add-guest">
                                <i class="fa fa-plus"></i>
                                Tamu Baru
                            </button>
                        `;
                        }
                    },
                    escapeMarkup(markup) {
                        return markup;
                    },
                })

                $('#checkindate').datetimepicker({
                    format: 'L',
                    locale: 'id',
                    minDate: new Date,
                })
                $('#checkoutdate').datetimepicker({
                    format: 'L',
                    locale: 'id',
                    useCurrent: false,
                })
                $("#checkindate").on("change.datetimepicker", function(e) {
                    $('#checkoutdate').datetimepicker('minDate', e.date)
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

                const roomDetailTable = $('#room-detail-table').DataTable({
                    "paging": false,
                    "searching": false,
                    "ordering": false,
                    "info": false,
                    "autoWidth": false,
                    "scrollX": true,
                    "responsive": true,
                })
                // End Library Configuration

                State.run()
                validateReservationForm()
                fetchRooms()
                $('#btn-save').hide()

                // Add Guest
                $('#btn-add-guest').click((e) => {
                    e.preventDefault()

                    const nik = $('#nik-add').val()
                    const name = $('#name-add').val()
                    const phone = $('#phone-add').val()
                    const email = $('#email-add').val()
                    const address = $('#address-add').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'post',
                        url: '/dashboard/guest',
                        data: {
                            nik,
                            name,
                            phone,
                            email,
                            address
                        },
                        beforeSend() {
                            $('.msg-error').text('')
                        },
                        success(res) {
                            alert(res.message, res.status)
                            $('#modal-add-guest').modal('hide')
                        },
                        error(res) {
                            const errors = res.responseJSON.errors
                            for (const key in errors) {
                                $(`.${key}-add-error`).text(errors[key])
                            }
                        }
                    })
                })

                $('#modal-add-guest').on('hidden.bs.modal', () => clearGuestForm())
                $('#modal-add-guest').on('show.bs.modal', () => {
                    $('#nik').select2('close')
                    $('.msg-error').text('')
                })
                // End Add Guest

                // Add Room
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
                        let newPrice = newRoom[0].room_type.room_prices.filter(roomPrice => roomPrice.id ==
                            price)
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
                            $('#btn-save').show()
                        }

                        const rooms = State.rooms.filter(value => value.id != room)
                        State.setRooms('rooms', rooms)

                        clearPriceForm()
                    } else {
                        $('#text-alert').text('Pilih kamar dan harga terlebih dahulu')
                        $('#modal-alert').modal('show')
                    }
                })

                $(document).on('click', '.btn-delete-detail-room', function() {
                    const roomNumber = roomDetailTable.row($(this).closest('tr')).data()[1]

                    const newRoom = State.initialRooms.filter(room => room.room_number == roomNumber)
                    State.rooms.push(newRoom[0])
                    State.setRooms('rooms', State.rooms)

                    const listOfRoomBooked = State.listOfRoomBooked.filter(roomBooked => roomBooked
                        .room_number != roomNumber)
                    State.setProperty('listOfRoomBooked', listOfRoomBooked)
                    if (!State.listOfRoomBooked.length) {
                        $('#btn-save').hide()
                    }

                    roomDetailTable.row($(this).parents('tr')).remove().draw()
                })

                $('#btn-save').click((e) => {
                    e.preventDefault()

                    const guestNik = $('#guest-nik').val()
                    const adult = $('#adult').val()
                    const children = $('#children').val()
                    const checkin = $('#checkin').val()
                    const checkout = $('#checkout').val()

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
                        url: '/dashboard/reservation',
                        data: {
                            guest_id: guestNik,
                            adult,
                            children,
                            checkin,
                            checkout,
                            discounts,
                            rooms,
                            prices
                        },
                        beforeSend() {
                            $('.msg-error').text('')
                        },
                        success(res) {
                            alert(res.message, res.status)
                            clearPriceForm()
                            clearReservationForm()
                            roomDetailTable.clear().draw()
                            State.listOfRoomBooked.length = 0
                        },
                        error(res) {
                            if (res.status === 400) {
                                alert(res.responseJSON.message, res.responseJSON.status)
                            }

                            if (res.status === 422) {
                                const errors = res.responseJSON.errors
                                for (const key in errors) {
                                    $(`.${key}-error`).text(errors[key])
                                }
                            }
                        }
                    })
                })
                // End Add Room
                // end Mounted

                // Methods
                function clearGuestForm() {
                    $('#nik-add').val('')
                    $('#name-add').val('')
                    $('#phone-add').val('')
                    $('#email-add').val('')
                    $('#address-add').val('')
                }

                function clearReservationForm() {
                    $('#guest-nik').val(null).trigger('change')
                    $('#checkin').val('')
                    $('#checkout').val('')
                    $('#children').val('')
                    $('#adult').val('')
                }

                function clearPriceForm() {
                    $('#price').children('option:not(:first)').remove()
                    $('#disc').val('')
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
