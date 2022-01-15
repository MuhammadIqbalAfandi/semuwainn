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

                                <span class="text-danger msg-error quantity-error"></span>
                            </div>
                        </div>

                        <div class="col-auto mt-4">
                            <button type="button" class="btn btn-sm btn-warning mt-2" id="btn-detail"><i
                                    class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </form>

                <x-restaurant-order.table-detail></x-restaurant-order.table-detail>
            </x-shared.card>
        </x-shared.content>
    </x-shared.content-wrapper>

    @push('scripts')
        <script>
            $(() => {
                // Mounted
                clearForm()

                fetchRestaurant()

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
            })
        </script>
    @endpush
</x-dashboard-layout>
