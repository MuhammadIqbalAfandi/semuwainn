<x-dashboard-layout title="Jenis Kamar">
    <!-- Room Type List -->
    <x-shared.content-wrapper id="room-type-list">
        <x-shared.content-header title="Jenis Kamar">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item active">Jenis Kamar</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-shared.card title="Daftar Jenis Kamar">
                <div class="row mb-2">
                    <div class="col">
                        <!-- Add Button -->
                        <button type="button" id="btn-add" class="btn btn-sm btn-warning float-right"><i
                                class="fa fa-plus"></i></button>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Jenis Kamar</th>
                                    <th>Fasilitas</th>
                                    <th>Harga</th>
                                    <th>Jumlah Kamar</th>
                                    <th>Jumlah tamu</th>
                                    <th>Tanggal Diperbaharui</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </x-shared.card>
        </x-shared.content>
    </x-shared.content-wrapper>

    <!-- Modal Add and Edit -->
    <x-shared.content-wrapper id="room-type-add-edit">
        <x-shared.content-header>
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.room-types.index') }}"
                        class="text-warning">Jenis
                        Kamar</a></li>
                <li class="breadcrumb-item active">Tambah Jenis Kamar</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-shared.card>
                <form>
                    <!-- Room Type Id -->
                    <input type="hidden" name="room_type_id" id="room-type-id" value="{{ old('room_type_id') }}">

                    <div class="row">
                        <div class="col-md-12 col-lg">
                            <!-- Room Name-->
                            <div class="form-group">
                                <label for="name">Nama Tipe Kamar</label>
                                <input type="text" name="name" id="name" value="{{ old('room_name') }}"
                                    class="form-control" placeholder="Tuliskan tipe kamar">

                                <span class="text-danger msg-error name-error"></span>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg">
                            <!-- Facility -->
                            <div class="form-group">
                                <label for="facilities">Fasilitas Kamar</label>
                                <select class="select2" multiple="multiple" name="facilities" id="facilities"
                                    multiple="multiple" style="width: 100%;">
                                    <option></option>
                                </select>

                                <span class="text-danger msg-error facilities-error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <!-- Number of guest -->
                            <div class="form-group">
                                <label for="number-of-guest">Jumlah tamu</label>
                                <input type="text" id="number-of-guest" name="number_of_guest" class="form-control"
                                    placeholder="Tuliskan jumlah tamu">

                                <span class="text-danger msg-error number_of_guest-error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown-divider"></div>

                    <div class="row">
                        <div class="col-12 mb-2">
                            <h3 class="font-weight-bold">Harga</h3>
                        </div>
                        <div class="col-12" id="dynamic-form-wrapper">
                            <div class="row d-flex align-items-center">
                                <div class="col">
                                    <!-- Description -->
                                    <div class="form-group">
                                        <label for="descriptions">Keterangan</label>
                                        <input type="text" id="descriptions" name="descriptions" class="form-control"
                                            placeholder="Tuliskan keterangan">

                                        <span class="text-danger msg-error descriptions-error"></span>
                                    </div>
                                </div>

                                <div class="col">
                                    <!-- Price -->
                                    <div class="form-group">
                                        <label for="prices">Harga</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text text-bold">Rp</span>
                                            </div>
                                            <input type="text" id="prices" name="prices" class="form-control"
                                                placeholder="Tuliskan harga">
                                        </div>
                                        <span class="text-danger msg-error prices-error"></span>
                                    </div>
                                </div>

                                <div class="col-1 mt-3 d-flex justify-content-end">
                                    <button type="button" class="btn btn-sm btn-warning" id="btn-add-price"><i
                                            class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button id="btn-save" type="submit" class="btn btn-block btn-warning">Simpan</button>
                    <button id="btn-edit" type="submit" class="btn btn-block btn-warning">Simpan</button>
                </form>
            </x-shared.card>
        </x-shared.content>
    </x-shared.content-wrapper>

    <!-- Delete -->
    <x-shared.modal id="modal-delete">
        <p>Yakin akan menghapus data ini?</p>

        <x-slot name="footer">
            <form class="mr-1">
                <!-- Room Type Id -->
                <input type="hidden" name="room_type_id" id="room-type-id-delete" value="{{ old('room_type_id') }}">
                <button type="submit" id="btn-delete" class="btn btn-warning float-right btn-rounded w-139">Ya</button>
            </form>
        </x-slot>
    </x-shared.modal>

    <!-- Alert -->
    {{-- <x-shared.modal id="modal-alert">
        <x-slot name="title">
            <i class="fa fa-exclamation-triangle text-danger"></i> Peringatan
        </x-slot>

        <h1>
            <span class="font-weight-bold">Opps!</span> kamu setidaknya <span class="font-weight-bold text-warning">haru
                memiliki satu fasilitas ruangan</span>, silahkan isi terlebih dahulu ya!
        </h1>

        <a class="btn btn-sm btn-warning mt-3 block" href="{{ route('facility.index') }}">Tambah Fasilitas</a>
    </x-shared.modal> --}}

    <x-slot name="script">
        <script>
            $(() => {
                // Mounted
                $('#facilities').select2({
                    placeholder: 'Pilih fasilitas kamar',
                    theme: 'bootstrap4'
                })

                $('.table').DataTable({
                    stateSave: true,
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    autoWidth: false,
                    ajax: 'room-types/room-types',
                    columns: [{
                            data: 'name',
                            name: 'name',
                        },
                        {
                            data: 'facility',
                            name: 'facility',
                        },
                        {
                            data: 'price',
                            name: 'price',
                        },
                        {
                            data: 'room-count',
                            name: 'room-count',
                        },
                        {
                            data: 'guest-count',
                            name: 'guest-count',
                        },
                        {
                            data: 'updated_at',
                            name: 'updated_at'
                        },
                        {
                            data: 'actions',
                            name: 'actions'
                        }
                    ],
                    language: {
                        processing: '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...',
                        emptyTable: "Data tidak tersedia!",
                        zeroRecords: "Data tidak ditemukan",
                        search: "Cari:",
                    },
                })

                $('#room-type-add-edit').toggle()

                $('#btn-add').click(() => {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'get',
                        url: 'room-types/facilities',
                        beforeSend() {
                            $('#room-type-list').toggle()
                            $('#btn-edit').toggle()
                            $('.content-header h1').text('Tambah Tipe Kamar')
                            $('.card-title').text('Form Tambah Tipe Kamar')
                            $('#room-type-add-edit').toggle()

                            clearForm()
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
                })

                $(document).on('click', '#btn-add-price', function() {
                    createRoomElement()
                })

                $(document).on('click', '.btn-remove-price', function() {
                    $(this).parents(':eq(0)').remove()
                })

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
                        type: 'post',
                        url: 'room-types',
                        data: {
                            name,
                            number_of_guest: numberOfGuest,
                            facilities,
                            descriptions,
                            prices,
                        },
                        beforeSend() {
                            $('.msg-error').text('')
                        },
                        success(res) {
                            alert(res.message, res.status)

                            $('#room-type-add-edit').toggle()
                            $('#btn-edit').toggle()
                            $('#room-type-list').toggle()

                            fetchRoomTypes()
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

                $(document).on('click', '.btn-show-edit', function() {
                    const id = $(this).attr('id')

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'get',
                        url: `room-types/${id}/edit`,
                        beforeSend() {
                            $('#room-type-list').toggle()
                            $('.breadcrumb-item.active').text('Ubah Jenis Kamar')
                            $('.content-header h1').text('Ubah Tipe Kamar')
                            $('.card-title').text('Form Ubah Tipe Kamar')
                            $('#btn-save').toggle()
                            $('#room-type-add-edit').toggle()

                            $('.msg-error').text('')
                            clearForm()
                        },
                        success(res) {
                            console.log("🚀 ~ file: index.blade.php ~ line 361 ~ success ~ res", res)
                            if (res.roomType && res.facilities) {
                                $('#room-type-id').val(res.roomType.id)
                                $('#name').val(res.roomType.name)
                                $('#number-of-guest').val(res.roomType.number_of_guest)

                                $('#dynamic-form-wrapper').children('.row:not(:first)').remove()
                                res.roomPrices.forEach((roomPrice, index) => {
                                    if (index) {
                                        createRoomElement()
                                    }
                                    $('input[name="prices"]')[index].value = roomPrice.price
                                    $('input[name="descriptions"]')[index].value = roomPrice
                                        .description
                                })

                                let optionSelected = []
                                res.roomType.room_facilities.forEach(roomFacility => {
                                    optionSelected.push(roomFacility.facility.id)
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
                        },
                    })
                })

                $('#btn-edit').click((e) => {
                    e.preventDefault()

                    const id = $('#room-type-id').val()
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
                        url: `room-types/${id}`,
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
                            $('#room-type-list').toggle()
                            $('#btn-save').toggle()
                            $('#room-type-add-edit').toggle()

                            fetchRoomTypes()
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

                $(document).on('click', '.btn-show-delete', function() {
                    const id = $(this).attr('id')
                    $('#room-type-id-delete').val(id)
                    $('.modal-title').html(`<i class="fa fa-exclamation-triangle text-danger"></i> Peringatan`)
                    $('#modal-delete').modal('show')
                })

                $('#btn-delete').click((e) => {
                    e.preventDefault()

                    const id = $('#room-type-id-delete').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'delete',
                        url: `room-types/${id}`,
                        success(res) {
                            alert(res.message, res.status)
                            $('#modal-delete').modal('hide')
                            fetchRoomTypes()
                        },
                        error(res) {
                            const {
                                message,
                                status
                            } = res.responseJSON
                            alert(message, status)
                            $('#modal-delete').modal('hide')
                        }
                    })
                })
                // end Mounted

                // Methods
                function clearForm() {
                    $('#name').val('')
                    $('#number-of-guest').val('')
                    $('input[name="prices"]').val('')
                    $('input[name="descriptions"]').val('')
                    $('#facilities').children('option:not(:first)').remove()
                }

                function createRoomElement() {
                    const priceElement = `
                        <div class="row d-flex align-items-center">
                            <div class="col">
                                <!-- Description -->
                                <div class="form-group">
                                    <label for="descriptions">Keterangan</label>
                                    <input type="text" name="descriptions" class="form-control"
                                        placeholder="Tuliskan keterangan">

                                    <span class="text-danger msg-error descriptions-error"></span>
                                </div>
                            </div>

                            <div class="col">
                                <!-- Price -->
                                <div class="form-group">
                                    <label for="prices">Harga</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-bold">Rp</span>
                                        </div>
                                        <input type="text" name="prices" class="form-control" placeholder="Tuliskan harga">
                                    </div>
                                    <span class="text-danger msg-error prices-error"></span>
                                </div>
                            </div>

                            <div class="col-1 mt-3 d-flex justify-content-end btn-remove-price">
                                <button type="button" class="btn btn-sm btn-warning"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    `

                    $('#dynamic-form-wrapper').append(priceElement)
                }

                function fetchRoomTypes() {
                    $('.table').DataTable().ajax.reload()
                }
                // end Methods
            })
        </script>
    </x-slot>
</x-dashboard-layout>
