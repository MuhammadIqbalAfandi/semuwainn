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
    <x-shared.modal id="modal-add">
        <form>
            <!-- Facility Id -->
            <input type="hidden" name="facility_id" id="facility-id" value="{{ old('facility_id') }}">

            <!-- Facility Name -->
            <div class="form-group">
                <label for="name">Nama Fasilitas</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name') }}" placeholder="Tulis nama fasilitas disini">

                <span class="text-danger msg-error name-error"></span>
            </div>

            <button id="btn-save" type="submit" class="btn btn-block btn-warning">Simpan</button>
            <button id="btn-edit" type="submit" class="btn btn-block btn-warning">Edit</button>
        </form>
    </x-shared.modal>

    <!-- Modal Delete -->
    <x-shared.modal id="modal-delete">
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
                    "lengthChange": false,
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
                    $('#btn-save').show()
                    $('#btn-edit').hide()
                    $('.modal-title').text('Tambah Fasilitas')
                    $('#modal-add').modal('show')
                })

                $('#btn-save').click((e) => {
                    e.preventDefault()

                    const name = $('#name').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'post',
                        url: 'facilities',
                        data: {
                            name,
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
                            const { errors, message, status } = res.responseJSON
                            if (status === 'failed') {
                                alert(message, status)
                            } else {
                                for (const key in errors) {
                                    $(`.${key}-error`).text(errors[key])
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
                        url: `facilities/${id}/edit`,
                        beforeSend() {
                            $('.msg-error').text('')
                            $('#btn-save').hide()
                            $('#btn-edit').show()
                            $('.modal-title').text('Ubah Fasilitas')
                            $('#modal-add').modal('show')
                        },
                        success(res) {
                            $('#facility-id').val(res.facility.id)
                            $('#name').val(res.facility.name)
                        },
                    })
                })

                $('#btn-edit').click((e) => {
                    e.preventDefault()

                    const id = $('#facility-id').val()
                    const name = $('#name').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'patch',
                        url: `facilities/${id}`,
                        data: {
                            id,
                            name,
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
                            const { errors, message, status } = res.responseJSON
                            if (status === 'failed') {
                                alert(message, status)
                            } else {
                                for (const key in errors) {
                                    $(`.${key}-error`).text(errors[key])
                                }
                            }
                        }
                    })
                })

                $(document).on('click', '.btn-show-delete', function() {
                    const id = $(this).attr('id')
                    $('#facility-id-delete').val(id)
                    $('.modal-title').html(`<i class="fa fa-exclamation-triangle text-danger"></i> Peringatan`)
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
                        url: `facilities/${id}`,
                        success(res) {
                            alert(res.message, res.status)
                            $('#modal-delete').modal('hide')
                            fetchFacilities()
                        },
                        error(res) {
                            const { message, status } = res.responseJSON
                            alert(message, status)
                            $('#modal-delete').modal('hide')
                        }
                    })
                })
                // end Mounted

                // Methods
                function clearForm() {
                    $('#name').val('')
                }

                function fetchFacilities() {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'get',
                        url: 'facilities/facilities',
                        success(res) {
                            if (res.data) {
                                facilitiesTable.clear().draw()

                                 res.data.forEach(facility => {
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
