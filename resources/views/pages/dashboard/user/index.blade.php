<x-dashboard-layout title="Akun User">
    <!-- User List -->
    <x-shared.content-wrapper>
        <x-shared.content-header title="Akun User">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item active">Akun User</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-shared.card title="Daftar Akun User">
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
                        <!-- User list -->
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No. HP / Email</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Hak Akses</th>
                                    <th>Tanggal Diperbaharui</th>
                                    <th>Status / Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </x-shared.card>
        </x-shared.content>
    </x-shared.content-wrapper>

    <!-- Modal Add & Edit -->
    <x-shared.modal title="Tambah Akun user" id="modal-add">
        <form>
            <!-- User Id -->
            <input type="hidden" name="user_id" id="user-id" value="{{ old('user_id') }}">

            <!-- Name -->
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control"
                    placeholder="Tulis nama disini">

                <span class="text-danger msg-error name-error"></span>
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label for="phone">Nomor HP</label>
                <input type="tel" id="phone" pattern="[0-9]*" name="phone" value="{{ old('phone') }}"
                    class="form-control" placeholder="Tulis nomor hp disini">

                <span class="text-danger msg-error phone-error"></span>
            </div>

            <!-- Address -->
            <div class="form-group">
                <label for="address">Alamat</label>
                <input type="address" name="address" id="address" value="{{ old('address') }}" class="form-control"
                    placeholder="Tulis alamat disini">

                <span class="text-danger msg-error address-error"></span>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class=" form-control"
                    placeholder="Tulis email disini">

                <span class="text-danger msg-error email-error"></span>
            </div>

            <!-- Hak Akses -->
            <div class="form-group">
                <label for="role">Hak Akses</label>
                <select class="form-control" name="role" id="role">
                    <option></option>
                </select>

                <span class="text-danger msg-error role-error"></span>
            </div>

            <button type="submit" id="btn-save" class="btn btn-block btn-warning">Simpan</button>
            <button type="submit" id="btn-edit" class="btn btn-block btn-warning">Simpan</button>
        </form>
    </x-shared.modal>

    <!-- Modal Block -->
    <x-shared.modal id="modal-block">
        <span id="block-msg">Yakin ingin mengubah status user</span>

        <x-slot name="footer">
            <form>
                <!-- User Id -->
                <input type="hidden" name="user_id" id="user-id-block">
                <button type="submit" id="btn-block" class="btn btn-warning float-right btn-rounded w-140">Ya</button>
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
                    ajax: 'users/users',
                    columns: [{
                            data: 'phone-email',
                            name: 'phone-email',
                        },
                        {
                            data: 'name',
                            name: 'name',
                        },
                        {
                            data: 'address',
                            name: 'address',
                        },
                        {
                            data: 'role',
                            name: 'role',
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

                $('#role').select2({
                    placeholder: 'Pilih hak akses',
                    theme: 'bootstrap4'
                })

                $('#btn-add').click(() => {
                    clearForm()
                    $('.msg-error').text('')
                    $('.modal-title').text('Tambah Akun User')
                    $('#btn-save').show()
                    $('#btn-edit').hide()
                    $('#modal-add').modal('show')
                })

                $('#btn-save').click((e) => {
                    e.preventDefault()

                    const name = $('#name').val()
                    const phone = $('#phone').val()
                    const email = $('#email').val()
                    const address = $('#address').val()
                    const roleId = $('#role').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'post',
                        url: 'users',
                        data: {
                            name,
                            phone,
                            email,
                            address,
                            role_id: roleId,
                        },
                        beforeSend() {
                            $('.msg-error').text('')
                        },
                        success(res) {
                            alert(res.message, res.status)
                            $('#modal-add').modal('hide')
                            fetchUsers()
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
                        url: `users/${id}/edit`,
                        beforeSend() {
                            $('.msg-error').text('')
                            $('#role').children('option:not(:first)').remove()
                            $('.modal-title').text('Ubah User')
                            $('#btn-save').hide()
                            $('#btn-edit').show()
                            $('#modal-add').modal('show')
                        },
                        success(res) {
                            if (res.user && res.roles) {
                                $('#user-id').val(res.user.id)
                                $('#name').val(res.user.name)
                                $('#phone').val(res.user.phone)
                                $('#email').val(res.user.email)
                                $('#address').val(res.user.address)

                                res.roles.forEach(role => {
                                    let newOption = new Option(role.name, role.id, false, res
                                        .user.role_id === role.id)
                                    $('#role').append(newOption)
                                })

                                $('#modal-add').modal('show')
                            }
                        },
                    })
                })

                $('#btn-edit').click((e) => {
                    e.preventDefault()

                    const id = $('#user-id').val()
                    const name = $('#name').val()
                    const phone = $('#phone').val()
                    const email = $('#email').val()
                    const address = $('#address').val()
                    const roleId = $('#role').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'patch',
                        url: `users/${id}`,
                        data: {
                            id,
                            name,
                            phone,
                            email,
                            address,
                            role_id: roleId,
                        },
                        beforeSend() {
                            $('.msg-error').text('')
                        },
                        success(res) {
                            alert(res.message, res.status)
                            $('#modal-add').modal('hide')
                            fetchUsers()
                        },
                        error(res) {
                            const {
                                errors
                            } = res.responseJSON
                            for (const key in errors) {
                                $(`.${key}-edit-error`).text(errors[key])
                            }
                        }
                    })
                })

                $(document).on('click', '.btn-show-block', function() {
                    const id = $(this).attr('id')
                    $('#user-id-block').val(id)
                    $('.modal-title').html(`<i class="fa fa-exclamation-triangle text-danger"></i> Peringatan`)
                    $('#modal-block').modal('show')
                })

                $('#btn-block').click((e) => {
                    e.preventDefault()

                    const id = $('#user-id-block').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'delete',
                        url: `users/${id}`,
                        success(res) {
                            alert(res.message, res.status)
                            $('#modal-block').modal('hide')
                            fetchUsers()
                        },
                    })
                })
                // end Mounted

                // Methods
                function clearForm() {
                    $('#name').val('')
                    $('#email').val('')
                    $('#phone').val('')
                    $('#address').val('')
                    $('#role').val('')
                }

                function fetchUsers() {
                    $('.table').DataTable().ajax.reload()
                }
                // end Methods
            })
        </script>
    </x-slot>
</x-dashboard-layout>
