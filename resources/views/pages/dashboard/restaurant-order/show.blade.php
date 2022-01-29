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

                                <span class="text-danger msg-error quantity-error"></span>
                            </div>
                        </div>

                        <div class="col-auto mt-4">
                            <button type="button" class="btn btn-sm btn-warning mt-2" id="btn-detail"><i
                                    class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </form>

                <x-restaurant-order.table-detail :reservationId="$reservationId"></x-restaurant-order.table-detail>
            </x-shared.card>
        </x-shared.content>
    </x-shared.content-wrapper>

    @prepend('scripts')
        <script>
            // Data
            const State = {
                initialRestaurants: [],
                listOfRestaurantBooked: [],
                error: false,
            }
            // end Data

            // Mounted
            clearForm()
            fetchRestaurant()

            const table = $('.table').DataTable()

            $('#btn-detail').click(() => {
                const id = $('#restaurant').find(':selected').val()
                const quantity = $('#quantity').val()

                State.error = false
                $('.msg-error').text('')
                if (isNaN(quantity)) {
                    $('.quantity-error').text('Nilai harus angka')
                    State.error = true
                }
                if (!quantity) {
                    $('.quantity-error').text('Nilai tidak boleh kosong')
                    State.error = true
                }
                if (!id) {
                    $('.restaurant-error').text('Nilai tidak boleh kosong')
                    State.error = true
                }
                if (State.error) {
                    return
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
            // end Mounted

            // Methods
            function fetchRestaurant() {
                $('#restaurant').select2({
                    placeholder: 'Pilih Hidangan',
                    theme: 'bootstrap4',
                })

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

            function clearForm() {
                $('#restaurant').val(null).trigger('change');
                $('#quantity').val('')
            }
            // end Methods
        </script>
    @endprepend
</x-dashboard-layout>
