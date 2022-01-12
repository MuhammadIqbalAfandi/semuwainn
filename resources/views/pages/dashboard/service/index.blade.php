<x-dashboard-layout title="Layanan">
    <!-- Service List -->
    <x-shared.content-wrapper>
        <x-shared.content-header title="Layanan">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item active">Layanan</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-shared.card title="Daftar Layanan">
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
                                    <th>Nama Layanan</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
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

    <!-- Modal Add & Edit -->
    <x-shared.modal id="modal-add">
        <form>
            <!-- Service Id -->
            <input type="hidden" name="service_id" id="service-id" value="{{ old('service_id') }}">

            <!-- Service Name -->
            <div class="form-group">
                <label for="name">Nama Layanan</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                    placeholder="Tulis nama layanan disini">

                <span class="text-danger msg-error name-error"></span>
            </div>

            <!-- Unit -->
            <div class="form-group">
                <label for="unit">Satuan</label>
                <input type="text" name="unit" id="unit" class="form-control" value="{{ old('unit') }}"
                    placeholder="Tulis nama satuan disini">

                <span class="text-danger msg-error unit-error"></span>
            </div>

            <!-- Price -->
            <div class="form-group">
                <label for="price">Harga</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text text-bold">Rp</span>
                    </div>

                    <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}"
                        placeholder="Tulis harga disini">

                </div>
                <span class="text-danger msg-error price-error"></span>
            </div>

            <button type="submit" id="btn-save" class="btn btn-block btn-warning">Simpan</button>
            <button type="submit" id="btn-edit" class="btn btn-block btn-warning">Simpan</button>
        </form>
    </x-shared.modal>

    <!-- Modal Delete -->
    <x-shared.modal id="modal-delete">
        <p>Yakin akan menghapus data ini?</p>

        <x-slot name="footer">
            <form class="mr-1">
                <!-- Service id -->
                <input type="hidden" name="service_id" id="service-id-delete" value="{{ old('service_id') }}">
                <button type="submit" id="btn-delete" class="btn btn-warning float-right btn-rounded w-139">Ya</button>
            </form>
        </x-slot>
    </x-shared.modal>

    <x-slot name="script">
        <script>
            $(() => {
                // Mounted
                $('.table').DataTable({
                    stateSave: true,
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    autoWidth: false,
                    ajax: 'services/services',
                    columns: [{
                            data: 'name',
                            name: 'name',
                        },
                        {
                            data: 'unit',
                            name: 'unit',
                        },
                        {
                            data: 'price',
                            name: 'price',
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

                $('#btn-add').click(() => {
                    clearForm()
                    $('.msg-error').text('')
                    $('#btn-save').show()
                    $('#btn-edit').hide()
                    $('.modal-title').text('Tambah Layanan')
                    $('#modal-add').modal('show')
                })

                $('#btn-save').click((e) => {
                    e.preventDefault()

                    const name = $('#name').val()
                    const unit = $('#unit').val()
                    const price = $('#price').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'post',
                        url: 'services',
                        data: {
                            name,
                            unit,
                            price,
                        },
                        beforeSend() {
                            $('.msg-error').text('')
                        },
                        success(res) {
                            alert(res.message, res.status)
                            $('#modal-add').modal('hide')
                            fetchServices()
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
                        url: `services/${id}/edit`,
                        beforeSend() {
                            $('.msg-error').text('')
                            $('#btn-save').hide()
                            $('#btn-edit').show()
                            $('.modal-title').text('Ubah Layanan')
                            $('#modal-add').modal('show')
                        },
                        success(res) {
                            const {
                                id,
                                name,
                                unit,
                                price
                            } = res
                            $('#service-id').val(id)
                            $('#name').val(name)
                            $('#unit').val(unit)
                            $('#price').val(price)
                        },
                    })
                })

                $('#btn-edit').click((e) => {
                    e.preventDefault()

                    const id = $('#service-id').val()
                    const name = $('#name').val()
                    const unit = $('#unit').val()
                    const price = $('#price').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'patch',
                        url: `services/${id}`,
                        data: {
                            id,
                            name,
                            unit,
                            price,
                        },
                        beforeSend() {
                            $('.msg-error').text('')
                        },
                        success(res) {
                            alert(res.message, res.status)
                            $('#modal-add').modal('hide')
                            fetchServices()
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
                                    $(`.${key}-error`).text(errors[key])
                                }
                            }
                        }
                    })
                })

                $(document).on('click', '.btn-show-delete', function() {
                    const id = $(this).attr('id')
                    $('#service-id-delete').val(id)
                    $('.modal-title').html(`<i class="fa fa-exclamation-triangle text-danger"></i> Peringatan`)
                    $('#modal-delete').modal('show')
                })

                $('#btn-delete').click((e) => {
                    e.preventDefault()

                    const id = $('#service-id-delete').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'delete',
                        url: `services/${id}`,
                        success(res) {
                            alert(res.message, res.status)
                            $('#modal-delete').modal('hide')
                            fetchServices()
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
                    $('#unit').val('')
                    $('#price').val('')
                }

                function fetchServices() {
                    $('.table').DataTable().ajax.reload()
                }
                // end Mothods
            });
        </script>
    </x-slot>
</x-dashboard-layout>
