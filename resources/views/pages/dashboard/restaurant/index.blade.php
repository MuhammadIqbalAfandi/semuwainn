<x-dashboard-layout title="Hidangan Restoran">
    <!-- Restaurant List -->
    <x-shared.content-wrapper>
        <x-shared.content-header title="Hidangan Restoran">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item active">Hidangan Restoran</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-shared.card title="Daftar Hidangan Restoran">
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
                                    <th>Nama Hidangan</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Tanggal Ditambahkan</th>
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
    <x-shared.modal title="Tambah Hidangan Restoran" id="modal-add">
        <form>
            <!-- Restaurant Id -->
            <input type="hidden" name="restaurant_id" id="restaurant-id" value="{{ old('restaurant_id') }}">

            <!-- Item Name -->
            <div class="form-group">
                <label for="name">Nama Hidangan</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                    placeholder="Tulis nama hidangan disini">

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

            <button id="btn-save" type="submit" class="btn btn-block btn-warning">Simpan</button>
            <button id="btn-edit" type="submit" class="btn btn-block btn-warning">Simpan</button>
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
                <!-- Restaurant Id -->
                <input type="hidden" name="restaurant_id" id="restaurant-id-delete">
                <button type="submit" id="btn-delete" class="btn btn-warning float-right btn-rounded w-140">Ya</button>
            </form>
        </x-slot>
    </x-shared.modal>

    <x-slot name="script">
        <script>
            $(() => {
                // Mounted
                const restaurantsTable = $('.table').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "scrollX": true,
                })

                fetchRestaurants()

                $('#btn-add').click(() => {
                    clearForm()
                    $('.msg-error').text('')
                    $('#btn-save').show()
                    $('#btn-edit').hide()
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
                        url: 'restaurants',
                        data: {
                            name,
                            unit,
                            price
                        },
                        beforeSend() {
                            $('.msg-error').text('')
                        },
                        success(res) {
                            alert(res.message, res.status)
                            $('#modal-add').modal('hide')
                            fetchRestaurants()
                        },
                        error(res) {
                            const { errors } = res.responseJSON
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
                        url: `restaurants/${id}/edit`,
                        beforeSend() {
                            $('.msg-error').text('')
                            $('#btn-save').hide()
                            $('#btn-edit').show()
                            $('#modal-add').modal('show')
                        },
                        success(res) {
                            $('#restaurant-id').val(res.restaurant.id)
                            $('#name').val(res.restaurant.name)
                            $('#unit').val(res.restaurant.unit)
                            $('#price').val(res.restaurant.price)
                        },
                    })
                })

                $('#btn-edit').click((e) => {
                    e.preventDefault()

                    const id = $('#restaurant-id').val()
                    const name = $('#name').val()
                    const unit = $('#unit').val()
                    const price = $('#price').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'patch',
                        url: `restaurants/${id}`,
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
                            fetchRestaurants()
                            clearForm()
                        },
                        error(res) {
                            const { errors } = res.responseJSON
                            for (const key in errors) {
                                $(`.${key}-error`).text(errors[key])
                            }
                        }
                    })
                })

                $(document).on('click', '.btn-show-delete', function() {
                    const id = $(this).attr('id')
                    $('#restaurant-id-delete').val(id)
                    $('#modal-delete').modal('show')
                })

                $('#btn-delete').click((e) => {
                    e.preventDefault()

                    const id = $('#restaurant-id-delete').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'delete',
                        url: `restaurants/${id}`,
                        success(res) {
                            alert(res.message, res.status)
                            $('#modal-delete').modal('hide')
                            fetchRestaurants()
                        },
                    })
                })
                // end Mounted

                // Methods
                function clearForm() {
                    $('#name').val('')
                    $('#unit').val('')
                    $('#price').val('')
                }

                function fetchRestaurants() {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'get',
                        url: 'restaurants/restaurants',
                        success(res) {
                            if (res.data) {
                                restaurantsTable.clear().draw()

                                 res.data.forEach(restaurant => {
                                    let btnAction = `
                                        <!-- Button Edit -->
                                        <i class="fas fa-edit mr-1 btn-show-edit text-primary" data-toggle="modal"
                                            id="${restaurant.id}"></i>

                                        <!-- Button Delete -->
                                        <i class="fas fa-trash-alt btn-show-delete text-danger" data-toggle="modal"
                                            id="${restaurant.id}">
                                        </i>
                                    `
                                    restaurantsTable.row.add([
                                        restaurant.name,
                                        restaurant.unit,
                                        idMoneyFormat(restaurant.price),
                                        idDateFormat(restaurant.updated_at),
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
