<x-dashboard-layout title="Pemesanan Kamar">
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
                <x-reservation.create.form></x-reservation.create.form>

                <div class="row my-5">
                    <div class="col">
                        <table id="room-detail-table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Tipe Kamar</th>
                                    <th>No. Kamar</th>
                                    <th>Harga</th>
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

            <x-reservation.create.modal-add-guest></x-reservation.create.modal-add-guest>

            <x-reservation.create.modal-delete></x-reservation.create.modal-delete>
        </x-shared.content>
    </x-shared.content-wrapper>

    @prepend('scripts')
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
    @endprepend
</x-dashboard-layout>
