<x-dashboard-layout title="Hidangan Restoran">
    <!-- Restaurant List -->
    <x-dashboard-content-wrapper>
        <x-dashboard-content-header title="Hidangan Restoran">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item active">Hidangan Restoran</li>
            </x-slot>
        </x-dashboard-content-header>

        <x-dashboard-content>
            <x-dashboard-card title="Daftar Hidangan Restoran">
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
            </x-dashboard-card>
        </x-dashboard-content>
    </x-dashboard-content-wrapper>

    <!-- Modal Add & Edit -->
    <x-dashboard-modal title="Tambah Hidangan Restoran" id="modal-add">
        <form>
            <!-- Restaurant Id -->
            <input type="hidden" name="restaurant_id" id="restaurant-id" value="{{ old('restaurant_id') }}">

            <!-- Item Name -->
            <div class="form-group">
                <label for="item-name">Nama Hidangan</label>
                <input type="text" name="item_name" id="item-name" class="form-control" value="{{ old('item_name') }}"
                    placeholder="Tulis nama hidangan disini">

                <span class="text-danger msg-error item_name-error"></span>
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

                    <span class="text-danger msg-error price-error"></span>
                </div>
            </div>

            <button id="btn-save" type="submit" class="btn btn-block btn-warning">Simpan</button>
            <button id="btn-edit" type="submit" class="btn btn-block btn-warning">Simpan</button>
        </form>
    </x-dashboard-modal>

    <!-- Modal Delete -->
    <x-dashboard-modal id="modal-delete">
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
    </x-dashboard-modal>

    <x-slot name="script">
        <script>
            $(() => {
                // Mounted
                const restaurantsTable = $('.table').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                })

                fetchRestaurants()

                $('#btn-add').click(() => {
                    clearForm()
                    $('.msg-error').text('')
                    $('.modal-title').text('Tambah Hidangan Restoran')
                    $('#btn-save').show()
                    $('#btn-edit').hide()
                    $('#modal-add').modal('show')
                })

                $('#btn-save').click((e) => {
                    e.preventDefault()

                    const itemName = $('#item-name').val()
                    const unit = $('#unit').val()
                    const price = $('#price').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'post',
                        url: 'restaurant',
                        data: {
                            item_name: itemName,
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
                        url: `restaurant/${id}/edit`,
                        beforeSend() {
                            $('.msg-error').text('')
                            $('.modal-title').text('Ubah Hidangan Restoran')
                            $('#btn-save').hide()
                            $('#btn-edit').show()
                            $('#modal-add').modal('show')
                        },
                        success(res) {
                            $('#restaurant-id').val(res.restaurant.id)
                            $('#item-name').val(res.restaurant.item_name)
                            $('#unit').val(res.restaurant.unit)
                            $('#price').val(res.restaurant.price)
                        },
                    })
                })

                $('#btn-edit').click((e) => {
                    e.preventDefault()

                    const id = $('#restaurant-id').val()
                    const itemName = $('#item-name').val()
                    const unit = $('#unit').val()
                    const price = $('#price').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'patch',
                        url: `restaurant/${id}`,
                        data: {
                            id,
                            item_name: itemName,
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
                            const errors = res.responseJSON.errors
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
                        url: `restaurant/${id}`,
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
                    $('#item-name').val('')
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
                        url: 'restaurant/restaurants',
                        success(res) {
                            if (res.restaurants) {
                                restaurantsTable.clear().draw()

                                 res.restaurants.forEach(restaurant => {
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
                                        restaurant.item_name,
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
