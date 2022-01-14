<x-dashboard-layout title="Ubah Tipe Kamar ">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Ubah Tipe Kamar">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.room-types.index') }}"
                        class="text-warning">Tipe Kamar</a></li>
                <li class="breadcrumb-item active">Ubah Tipe Kamar</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-room-type.form title="Ubah Tipe Kamar" :roomType="$roomType"></x-room-type.form>
        </x-shared.content>
    </x-shared.content-wrapper>

    @push('scripts')
        <script>
            $(() => {
                // Mounted
                const id = $('#room-type-id').val()
                fetchService()
                fetchPrice()

                $('#btn-save').click((e) => {
                    e.preventDefault()

                    const name = $('#name').val()
                    const facilities = $('#facilities').val()
                    const numberOfGuest = $('#number-of-guest').val()

                    const descriptions = []
                    const elementDescriptions = $('input[name="descriptions"]')
                    for (elementDescription of elementDescriptions) {
                        descriptions.push(elementDescription.value)
                    }

                    const prices = []
                    const elementPrices = $('input[name="prices"]')
                    for (elementPrice of elementPrices) {
                        prices.push(elementPrice.value)
                    }

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'patch',
                        url: `/dashboard/room-types/${id}`,
                        data: {
                            id,
                            number_of_guest: numberOfGuest,
                            name,
                            facilities,
                            descriptions,
                            prices,
                        },
                        beforeSend() {
                            $('.msg-error').text('')
                        },
                        success(res) {
                            alert(res.message, res.status)
                        },
                        error(res) {
                            const {
                                errors,
                                message,
                                status
                            } = res.responseJSON
                            if (status === 'failed') {
                                alert(message, status)
                            } else {
                                for (const key in errors) {
                                    let fieldError = key.split('.')
                                    const regex = /.[0-9]/
                                    const textError = String(errors[key])

                                    if (fieldError.length === 1) {
                                        $(`.${fieldError[0]}-error`).text(textError)
                                    } else {
                                        $(`.${fieldError[0]}-error`)[fieldError[1]].innerText =
                                            textError.replace(regex, '')
                                    }
                                }
                            }
                        }
                    })
                })
                // end Mounted

                // Methods
                function fetchService() {
                    $('#facilities').select2({
                        placeholder: 'Pilih fasilitas kamar',
                        theme: 'bootstrap4'
                    })

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'get',
                        url: `/dashboard/room-types/room-facilities/${id}`,
                        beforeSend() {
                            $('#facilities').children('option:not(:first)').remove()
                        },
                        success(res) {
                            if (res) {
                                let optionSelected = []
                                res.roomFacilities.forEach(roomFacility => {
                                    optionSelected.push(roomFacility.facility_id)
                                })

                                res.facilities.forEach(facility => {
                                    let newOption = new Option(
                                        facility.name, facility.id,
                                        false,
                                        optionSelected.includes(facility.id)
                                    )
                                    $('#facilities').append(newOption)
                                })
                            }
                        }
                    })
                }

                function fetchPrice() {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'get',
                        url: `/dashboard/room-types/room-prices/${id}`,
                        success(res) {
                            if (res) {
                                res.forEach((roomPrice, index) => {
                                    if (index) {
                                        createRoomElement()
                                    }
                                    $('input[name="prices"]')[index].value = roomPrice.price
                                    $('input[name="descriptions"]')[index].value = roomPrice.description
                                })
                            }
                        },
                    })
                }
                // end Methods
            })
        </script>
    @endpush
</x-dashboard-layout>