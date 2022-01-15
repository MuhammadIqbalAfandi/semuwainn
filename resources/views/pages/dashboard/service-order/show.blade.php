<x-dashboard-layout title="Tambah Layanan">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Tambah Layanan">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.reservations.index') }}"
                        class="text-warning">Daftar
                        Pemesanan Kamar</a></li>
                <li class="breadcrumb-item active">Tambah Layanan</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-shared.card title="Tambah Layanan">
                <form>
                    <input id="reservation-id" type="hidden" value="{{ $reservationId }}" />

                    <div class="row">
                        <div class="cols-md-12 col-lg">
                            <div class="form-group">
                                <label for="service">Tambah Layanan</label>
                                <select class="select2" name="service" id="service" style="width: 100%;">
                                    <option></option>
                                </select>

                                <span class="text-danger msg-error service-error"></span>
                            </div>
                        </div>

                        {{-- <div class="col col-lg">
                            <div class="cols-md-12 col-lg">
                                <div class="form-group">
                                    <label for="room">Pilih Kamar</label>
                                    <select class="select2" name="room" id="room" multiple style="width: 100%;">
                                        <option></option>
                                    </select>

                                    <span class="text-danger msg-error room-error"></span>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-auto mt-4">
                            <button type="button" class="btn btn-sm btn-warning mt-2" id="btn-detail"><i
                                    class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </form>

                <x-service-order.table-detail></x-service-order.table-detail>

            </x-shared.card>
        </x-shared.content>
    </x-shared.content-wrapper>

    @push('scripts')
        <script>
            // Mounted
            const id = $('#reservation-id').val()
            fetchService()
            // fetchRoom()

            $('#btn-detail').click(() => {
                const serviceId = $('#service').find(':selected').val()
                // const roomId = $('#room').find(':selected').val()

                State.error = false
                $('.msg-error').text('')
                if (!serviceId) {
                    $('.service-error').text('Nilai tidak boleh kosong')
                    State.error = true
                }
                // if (!roomId) {
                //     $('.room-error').text('Nilai tidak boleh kosong')
                //     State.error = true
                // }
                if (State.error) {
                    return
                }

                const service = State.initialServices.find((service) => service.id == serviceId)
                // const room = State.initialRooms.find((room) => room.id == roomId)
                if (service) {
                    table.row.add([
                        service.name,
                        // `<span class="badge badge-pill badge-warning">${room.room_number}</span>`,
                        idMoneyFormat(service.price),
                        `
                            <button type="button" data-id-service="${service.id}"
                                class="btn btn-delete-detail text-danger">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        `,
                    ]).draw(false)

                    State.listOfServiceBooked.push(service)
                    // State.listOfRoomBooked.push(room)
                    fetchService()
                    // fetchRoom()
                    clearForm()
                }
            })
            // end Mounted
        </script>
    @endpush
</x-dashboard-layout>
