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
                fetchService()
                fetchPrice()

                $('#form').submit(function(e) {
                    e.preventDefault()

                    const formData = new FormData(this)

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        cache: false,
                        processData: false,
                        contentType: false,
                        type: 'post',
                        url: "{{ route('dashboard.room-types.update', $roomType->id) }}",
                        data: formData,
                        beforeSend() {
                            $('.msg-error').text('')
                        },
                        success(res) {
                            const {
                                message,
                                status
                            } = res

                            alert(message, status)
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
                                    const fieldError = key.split('.')
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
                        url: "{{ route('dashboard.room-types.room-facilities', $roomType->id) }}",
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
                        url: "{{ route('dashboard.room-types.room-prices', $roomType->id) }}",
                        success(res) {
                            if (res) {
                                res.forEach((roomPrice, index) => {
                                    if (index) {
                                        createRoomElement()
                                    }
                                    $('input[name="prices[]"]')[index].value = roomPrice.price
                                    $('input[name="descriptions[]"]')[index].value = roomPrice
                                        .description
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
