<x-dashboard-layout title="Tambah Tipe Kamar">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Tambah Tipe Kamar">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.room-types.index') }}"
                        class="text-warning">Tambah Tipe
                        Kamar</a></li>
                <li class="breadcrumb-item active">Tambah Tipe Kamar</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-dashboard.room-type.form title="Tambah Tipe Kamar">
            </x-dashboard.room-type.form>
        </x-shared.content>
    </x-shared.content-wrapper>

    @push('scripts')
        <script>
            // Mounted
            fetchService()
            // end Mounted

            // Mounted
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
                    url: "{{ route('dashboard.room-types.store') }}",
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
                        clearForm()
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
            function clearForm() {
                $('[name="name"]').val('')
                $('[name="number_of_guest"]').val('')
                $('[name="descriptions[]"]').val('')
                $('[name="prices[]"]').val('')
                $('[name="facilities[]"]').val(null).trigger('change');
                $('#thumbnails').filepond('removeFiles')
            }

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
                    url: "{{ route('dashboard.room-types.facilities') }}",
                    beforeSend() {
                        $('#facilities').children('option:not(:first)').remove()
                    },
                    success(res) {
                        if (res) {
                            res.forEach(facility => {
                                let newOption = new Option(facility.name, facility.id,
                                    false, false)
                                $('#facilities').append(newOption)
                            })
                        }
                    }
                })
            }
            // end Methods
        </script>
    @endpush
</x-dashboard-layout>
