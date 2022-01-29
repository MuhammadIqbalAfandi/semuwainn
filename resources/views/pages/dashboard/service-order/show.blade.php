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

                        <div class="col-auto mt-4">
                            <button type="button" class="btn btn-sm btn-warning mt-2" id="btn-detail"><i
                                    class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </form>

                <x-service-order.table-detail :reservationId="$reservationId"></x-service-order.table-detail>
            </x-shared.card>
        </x-shared.content>
    </x-shared.content-wrapper>

    @prepend('scripts')
        <script>
            // Data
            const State = {
                initialServices: [],
                listOfServiceBooked: [],
                error: false,
            }
            // end Data

            // Mounted
            fetchService()

            const table = $('.table').DataTable()

            $('#btn-detail').click(() => {
                const serviceId = $('#service').find(':selected').val()

                State.error = false
                $('.msg-error').text('')
                if (!serviceId) {
                    $('.service-error').text('Nilai tidak boleh kosong')
                    State.error = true
                }
                if (State.error) {
                    return
                }

                const service = State.initialServices.find((service) => service.id == serviceId)
                if (service) {
                    table.row.add([
                        service.name,
                        idMoneyFormat(service.price),
                        `
                            <button type="button" data-id-service="${service.id}"
                                class="btn btn-delete-detail text-danger">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        `,
                    ]).draw(false)

                    State.listOfServiceBooked.push(service)
                    fetchService()
                    clearForm()
                }
            })
            // end Mounted

            // Methods
            function fetchService() {
                $('#service').select2({
                    placeholder: 'Pilih Layanan',
                    theme: 'bootstrap4',
                })

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    type: 'get',
                    url: "{{ route('dashboard.service-orders.edit', $reservationId) }}",
                    beforeSend() {
                        $('#service').children('option:not(:first)').remove()
                    },
                    success(res) {
                        if (res) {
                            State.initialServices = res

                            const services = _.differenceBy(res, State.listOfServiceBooked, 'id')
                            services.forEach((service) => {
                                let newOption = new Option(service.name, service.id, false, false)
                                $('#service').append(newOption)
                            })
                        }
                    }
                })
            }

            function clearForm() {
                $('#service').val(null).trigger('change');
            }
            // end Methods
        </script>
    @endprepend
</x-dashboard-layout>
