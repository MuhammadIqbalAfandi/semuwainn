<x-dashboard-layout title="Fasilitas">
    <!-- Facility List -->
    <x-shared.content-wrapper>
        <x-shared.content-header title="Fasilitas">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item active">Fasilitas</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-shared.card title="Daftar Fasilitas">
                <div class="row mb-2">
                    <div class="col">
                        <!-- Add Button -->
                        <button type="button" id="btn-add" class="btn btn-sm btn-warning float-right"
                            data-toggle="modal">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Fasilitas</th>
                                    <th>Jumlah Kamar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </x-shared.card>
        </x-shared.content>
    </x-shared.content-wrapper>

    <!-- Modal Add & Edit -->
    <x-shared.modal title="Tambah Fasilitas" id="modal-add">
        <form>
            <!-- Facility Id -->
            <input type="hidden" name="facility_id" id="facility-id" value="{{ old('facility_id') }}">

            <!-- Facility Name -->
            <div class="form-group">
                <label for="facility-name">Nama Fasilitas</label>
                <input type="text" name="facility_name" id="facility-name" class="form-control"
                    value="{{ old('facility_name') }}" placeholder="Tulis nama fasilitas disini">

                <span class="text-danger msg-error facility_name-error"></span>
            </div>

            <button id="btn-save" type="submit" class="btn btn-block btn-warning">Simpan</button>
            <button id="btn-edit" type="submit" class="btn btn-block btn-warning">Edit</button>
        </form>
    </x-shared.modal>

    <!-- Modal Delete -->
    <x-shared.modal id="modal-delete">
        <x-slot name="title">
            <i class="fa fa-exclamation-triangle text-danger"></i> Peringatan
        </x-slot>

        <p>Yakin akan menghapus data ini?</p>

        <x-slot name="footer">
            <form class="mr-1">

                <!-- Facility Id -->
                <input type="hidden" name="facility_id" id="facility-id-delete">
                <button type="submit" id="btn-delete" class="btn btn-warning float-right btn-rounded w-140">Ya</button>
            </form>
        </x-slot>
    </x-shared.modal>

    <x-slot name="script">
        <script>
            $(() => {
                // Mounted
                const facilitiesTable = $('.table').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "scrollX": true,
                })

                fetchFacilities()

                $('#btn-add').click(() => {
                    clearForm()
                    $('.msg-error').text('')
                    $('.modal-title').text('Tambah Fasilitas')
                    $('#btn-save').show()
                    $('#btn-edit').hide()
                    $('#modal-add').modal('show')
                })

                $('#btn-save').click((e) => {
                    e.preventDefault()

                    const facilityName = $('#facility-name').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'post',
                        url: 'facility',
                        data: {
                            name: facilityName,
                        },
                        beforeSend() {
                            $('.msg-error').text('')
                        },
                        success(res) {
                            alert(res.message, res.status)
                            $('#modal-add').modal('hide')
                            fetchFacilities()
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
                        dataType: 'json',
                        type: 'get',
                        url: `facility/${id}/edit`,
                        beforeSend() {
                            $('.msg-error').text('')
                            $('.modal-title').text('Ubah Fasilitas')
                            $('#btn-save').hide()
                            $('#btn-edit').show()
                            $('#modal-add').modal('show')
                        },
                        success(res) {
                            $('#facility-id').val(res.facility.id)
                            $('#facility-name').val(res.facility.name)
                        },
                    })
                })

                $('#btn-edit').click((e) => {
                    e.preventDefault()

                    const id = $('#facility-id').val()
                    const facilityName = $('#facility-name').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'patch',
                        url: `facility/${id}`,
                        data: {
                            id,
                            name: facilityName,
                        },
                        beforeSend() {
                            $('.msg-error').text('')
                        },
                        success(res) {
                            alert(res.message, res.status)
                            $('#modal-add').modal('hide')
                            fetchFacilities()
                            clearForm()
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
                    $('#facility-id-delete').val(id)
                    $('#modal-delete').modal('show')
                })

                $('#btn-delete').click((e) => {
                    e.preventDefault()

                    const id = $('#facility-id-delete').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'delete',
                        url: `facility/${id}`,
                        success(res) {
                            alert(res.message, res.status)
                            $('#modal-delete').modal('hide')
                            fetchFacilities()
                        },
                    })
                })
                // end Mounted

                // Methods
                function clearForm() {
                    $('#facility-name').val('')
                }

                function fetchFacilities() {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'get',
                        url: 'facility/facilities',
                        success(res) {
                            if (res.facilities) {
                                facilitiesTable.clear().draw()

                                 res.facilities.forEach(facility => {
                                    let btnAction = `
                                        <!-- Button Edit -->
                                        <i class="fas fa-edit mr-1 btn-show-edit text-primary" data-toggle="modal"
                                            id="${facility.id}"></i>

                                        <!-- Button Delete -->
                                        <i class="fas fa-trash-alt btn-show-delete text-danger" data-toggle="modal"
                                            id="${facility.id}">
                                        </i>
                                    `
                                    facilitiesTable.row.add([
                                        facility.name,
                                        facility.room_facilities.length,
                                        btnAction
                                    ]).draw(false)
                                })
                            }
                        }
                    })
                }
                // end Methods
            });
        </script>
    </x-slot>
</x-dashboard-layout>
