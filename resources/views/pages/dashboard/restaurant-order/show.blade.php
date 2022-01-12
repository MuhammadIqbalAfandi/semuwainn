<x-dashboard-layout title="Tambah Hidangan">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Tambah Hidangan">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.reservations.index') }}"
                        class="text-warning">Daftar
                        Pemesanan Kamar</a></li>
                <li class="breadcrumb-item active">Tambah Hidangan</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-shared.card title="Tambah Hidangan">
                <form>
                    <input id="reservation-id" type="hidden" value="{{ $reservationId }}" />
                    <div class="row">
                        <div class="cols-md-12 col-lg">
                            <div class="form-group">
                                <label for="restaurant">Tambah Hidangan</label>
                                <select class="select2" name="restaurant" id="restaurant" style="width: 100%;">
                                    <option></option>
                                </select>

                                <span class="text-danger msg-error restaurant-error"></span>
                            </div>
                        </div>
                        <div class="col col-lg">
                            <div class="form-group">
                                <label>Kuantitas</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-bold"><i
                                                class="fas fa-calculator"></i></span>
                                    </div>
                                    <input class="form-control" name="quantity" id="quantity" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="col-auto d-flex align-items-center">
                            <button type="button" class="btn btn-sm btn-warning mt-3" id="btn-detail"><i
                                    class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nama Hidangan</th>
                            <th>Jumlah Pesanan</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>

                <div class="row mt-3">
                    <div class="col d-flex justify-content-end">
                        <button type="button" class="btn btn-sm btn-warning" id="btn-save"><i
                                class="fa fa-save"></i>
                            Simpan data pesanan</button>
                    </div>
                </div>
            </x-shared.card>
        </x-shared.content>
    </x-shared.content-wrapper>

    <x-slot name="script">
        <script>
            // Data
            const State = {
                initialRestaurants: [],
                listOfRestaurantBooked: [],
            }
            // end Data

            // Mounted
            clearForm()

            // Restaurant
            fetchRestaurant()

            $('#restaurant').select2({
                placeholder: 'Pilih Hidangan',
                theme: 'bootstrap4'
            })

            const table = $('.table').DataTable({
                paging: false,
                searching: false,
                ordering: false,
                info: false,
                autoWidth: false,
                scrollX: true,
                responsive: true,
            })
            // end Restaurant
            // end Mounted

            // Methods
            // Restaurant
            function fetchRestaurant() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    type: 'get',
                    url: '/dashboard/restaurant-orders',
                    beforeSend() {
                        $('#restaurant').children('option:not(:first)').remove()
                    },
                    success(res) {
                        if (res) {
                            State.initialRestaurants = res

                            const restaurants = _.differenceBy(res, State.listOfRestaurantBooked, 'id')
                            restaurants.forEach((restaurant) => {
                                let newOption = new Option(restaurant.name, restaurant.id,
                                    false, false)
                                $('#restaurant').append(newOption)
                            })
                        }
                    }
                })
            }

            $('#btn-detail').click(() => {
                const id = $('#restaurant').find(':selected').val()
                const quantity = $('#quantity').val()

                if (isNaN(quantity)) {
                    return alert('Nilai harus angka', 'failed')
                }
                if (!quantity || !id) {
                    return alert('Nilai tidak boleh kosong', 'failed')
                }

                const room = State.initialRestaurants.find((room) => room.id == id)
                if (room) {
                    table.row.add([
                        room.name,
                        quantity,
                        idMoneyFormat(room.price),
                        `
                            <button type="button" id="${room.id}" class="btn btn-delete-detail text-danger">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        `,
                    ]).draw(false)

                    State.listOfRestaurantBooked.push({
                        ...room,
                        quantity: Number(room.quantity) + Number(quantity)
                    })
                    fetchRestaurant()
                    clearForm()
                }
            })

            $(document).on('click', '.btn-delete-detail', function() {
                const id = $(this).attr('id')
                State.listOfRestaurantBooked = State.listOfRestaurantBooked.filter((restaurant) => restaurant.id != id)
                fetchRestaurant()

                table.row($(this).parents('tr')).remove().draw()
            })

            $('#btn-save').click(() => {
                const id = $('#reservation-id').val()
                const restaurants = State.listOfRestaurantBooked

                if (!restaurants.length) {
                    return alert('Pesanan tidak boleh kosong', 'failed')
                }

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    type: 'post',
                    url: `/dashboard/restaurant-orders`,
                    data: {
                        id,
                        restaurants,
                    },
                    success(res) {
                        const {
                            message,
                            status
                        } = res
                        alert(message, status)
                        fetchRestaurant()
                        table.clear().draw()
                    },
                    error(res) {
                        const {
                            message,
                            status,
                        } = res.responseJSON
                        alert(message, status)
                    }
                })
            })
            // end Restaurant

            function clearForm() {
                $('#restaurant').val(null).trigger('change');
                $('#quantity').val('')
            }
            // end Methods
        </script>
    </x-slot>
</x-dashboard-layout>