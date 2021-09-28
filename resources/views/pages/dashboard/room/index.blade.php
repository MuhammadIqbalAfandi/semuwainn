<x-dashboard-layout title="Kamar">
    <!-- Room List -->
    <x-dashboard-content-wrapper>
        <x-dashboard-content-header title="Kamar">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item active">Kamar</li>
            </x-slot>
        </x-dashboard-content-header>

        <x-dashboard-content>
            <x-dashboard-card title="Daftar Kamar">
                <div class="row mb-2">
                    <div class="col">
                        <!-- Add Button -->
                        <button type="button" id="btn-add" class="btn btn-sm btn-warning float-right">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nomor Kamar</th>
                                    <th>Jenis Kamar</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </x-dashboard-card>
        </x-dashboard-content>
    </x-dashboard-content-wrapper>

    <!-- Modal Add & Edit -->
    <x-dashboard-modal title="Tambah Kamar" id="modal-add">
        <form>
            <!-- Room Id -->
            <input type="hidden" name="room_id" id="room-id" value="{{ old('room_id') }}">

            <!-- Room Number -->
            <div class="form-group">
                <label for="room-number">Nomor Kamar</label>
                <input type="text" name="room_number" id="room-number" class="form-control"
                    value="{{ old('room_number') }}" placeholder="Tulis nomor kamar disini">

                <span class="text-danger msg-error room_number-error"></span>
            </div>

            <!-- Room Type -->
            <div class="form-group">
                <label for="room-type-id">Tipe Kamar</label>
                <select class="form-control" name="room_type_id" id="room-type-id" style="width: 100%;">
                    <option></option>
                </select>

                <span class="text-danger msg-error room_type_id-error"></span>
            </div>

            <button type="submit" id="btn-save" class="btn btn-block btn-warning">Simpan</button>
            <button type="submit" id="btn-edit" class="btn btn-block btn-warning">Simpan</button>
        </form>
    </x-dashboard-modal>

    <!-- Modal Delete -->
    <x-dashboard-modal id="modal-delete">
        <x-slot name="title">
            <i class="fa fa-exclamation-triangle text-danger"></i> Peringatan
        </x-slot>

        <p>Yakin akan menghapus data ini?</p>

        <x-slot name="footer">
            <form>
                <!-- Room Id -->
                <input type="hidden" name="room_id" id="room-id-delete">
                <button type="submit" id="btn-delete" class="btn btn-warning float-right btn-rounded w-140">Ya</button>
            </form>
        </x-slot>
    </x-dashboard-modal>

    <!-- Alert -->
    {{-- <x-dashboard-modal id="add-modal">
        <x-slot name="title">
            <i class="fa fa-exclamation-triangle text-danger"></i> Peringatan
        </x-slot>

        <h1>
            <span class="font-weight-bold">Opps!</span> kamu setidaknya <span
                class="font-weight-bold text-warning">harus
                memiliki satu jenis
                kamar</span>, silahkan isi terlebih dahulu ya!
        </h1>

        <a class="btn btn-sm btn-warning mt-3 block" href="{{ route('room-type.index') }}">Tambah Jenis Kamar</a>
    </x-dashboard-modal> --}}

    <x-slot name="script">
        <script>
            $(() => {
                // Mounted
                $('#room-type-id').select2({
                    placeholder: 'Pilih tipe kamar',
                    theme: 'bootstrap4'
                })

                const roomsTable = $('.table').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                })

                fetchRooms()

                $('#btn-add').click(() => {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'get',
                        url: 'room-type/room-types',
                        beforeSend() {
                            clearForm()
                            $('.modal-title').text('Tambah Ruangan')
                            $('#btn-save').show()
                            $('#btn-edit').hide()
                            $('#modal-add').modal('show')
                        },
                        success(res) {
                            if (res.roomTypes) {
                                res.roomTypes.forEach((roomType) => {
                                    let newOption = new Option(roomType.room_type_name, roomType.id, false, false)
                                    $('#room-type-id').append(newOption)
                                })
                            }
                        }
                    })

                    $('#modal-add').modal('show')
                })

                $('#btn-save').click((e) => {
                    e.preventDefault()

                    const roomNumber = $('#room-number').val()
                    const roomTypeId = $('#room-type-id').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'post',
                        url: 'room',
                        data: {
                            room_number: roomNumber,
                            room_type_id: roomTypeId ,
                        },
                        beforeSend() {
                            $('.msg-error').text('')
                        },
                        success(res) {
                            alert(res.message, res.status)
                            $('#modal-add').modal('hide')
                            fetchRooms()
                        },
                        error(res) {
                            const errors = res.responseJSON.errors
                            for (const key in errors) {
                               $(`.${key}-error`).text(errors[key])
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
                        type: 'get',
                        url: `room/${id}/edit`,
                        beforeSend() {
                            $('.msg-error').text('')
                            $('.modal-title').text('Ubah Ruangan')
                            $('#btn-save').hide()
                            $('#btn-edit').show()
                            $('#modal-add').modal('show')
                        },
                        success(res) {
                            $('#room-id').val(res.room.id)
                            $('#room-number').val(res.room.room_number)

                            res.roomTypes.forEach( roomType => {
                                let newOption = new Option(
                                    roomType.room_type_name,
                                    roomType.id,
                                    false,
                                    res.room.room_type.id === roomType.id
                                )
                                $('#room-type-id').append(newOption)
                            })
                        }
                    })

                    $('#modal-add').modal('show')
                })

                $('#btn-edit').click((e) => {
                    e.preventDefault()

                    const id = $('#room-id').val()
                    const roomNumber = $('#room-number').val()
                    const roomTypeId = $('#room-type-id').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'patch',
                        url: `room/${id}`,
                        data: {
                            id,
                            room_number: roomNumber,
                            room_type_id: roomTypeId,
                        },
                        success(res) {
                            alert(res.message, res.status)
                            $('#modal-add').modal('hide')
                            fetchRooms()
                        },
                        error(res) {
                            const errors = res.responseJSON.errors
                            for (const key in errors) {
                                $(`.${key}-error`).text(errors[key])
                            }
                        }
                    })
                })

                $(document).on('click', '.btn-show-delete', function() {
                    const id = $(this).attr('id')
                    $('#room-id-delete').val(id)

                    $('#modal-delete').modal('show')
                })

                $('#btn-delete').click((e) => {
                    e.preventDefault()

                    const id = $('#room-id-delete').val()
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'delete',
                        url: `room/${id}`,
                        success(res) {
                            alert(res.message, res.status)
                            $('#modal-delete').modal('hide')
                            fetchRooms()
                        },
                    })
                })
                // end Mounted

                // Methods
                function clearForm() {
                    $('#room-number').val('')
                    $('#room-type-id').children('option:not(:first)').remove()
                }

                function fetchRooms() {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'get',
                        url: 'room/rooms',
                        success(res) {
                            if (res.rooms) {
                                roomsTable.clear().draw()

                                res.rooms.forEach(room => {
                                    let btnAction = `
                                        <!-- Button Edit -->
                                        <i class="fas fa-edit mr-1 btn-show-edit text-primary" id="${room.id}">
                                        </i>

                                        <!-- Button Delete -->
                                        <i class="fas fa-trash-alt btn-show-delete text-danger" id="${room.id}">
                                        </i>
                                    `

                                    let roomStatus = room.room_order.length ?
                                    `
                                        <span class="d-block">Terisi</span>
                                        <span class="d-block text-secondary">Kosong</span>
                                    ` :
                                    `
                                        <span class="d-block text-secondary">Terisi</span>
                                        <span class="d-block">Kosong</span>
                                    `

                                    roomsTable.row.add([
                                        room.room_number,
                                        room.room_type.room_type_name,
                                        roomStatus,
                                        btnAction
                                    ]).draw(false)
                                })
                            }
                        }
                    })
                }
                // end Methods
            })
        </script>
    </x-slot>
</x-dashboard-layout>
