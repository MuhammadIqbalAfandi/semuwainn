<x-shared.modal title="Ubah Akun User" id="modal-edit">
    <form>
        <div class="form-group">
            <label for="name-edit">Nama</label>
            <input type="text" name="name" id="name-edit" class="form-control" placeholder="Tulis nama">

            <span class="text-danger msg-error name-error"></span>
        </div>

        <div class="form-group">
            <label for="phone-edit">Nomor HP</label>
            <input type="tel" id="phone-edit" pattern="[0-9]*" name="phone" class="form-control"
                placeholder="Tulis nomor hp">

            <span class="text-danger msg-error phone-error"></span>
        </div>

        <div class="form-group">
            <label for="address-edit">Alamat</label>
            <input type="address" name="address" id="address-edit" class="form-control" placeholder="Tulis alamat">

            <span class="text-danger msg-error address-error"></span>
        </div>

        <div class="form-group">
            <label for="email-edit">Email</label>
            <input type="email" name="email" id="email-edit" class=" form-control" placeholder="Tulis email">

            <span class="text-danger msg-error email-error"></span>
        </div>

        <div class="form-group">
            <label for="role-edit">Hak Akses</label>
            <select class="select2" name="role_id" id="role-edit">
                <option></option>
            </select>

            <span class="text-danger msg-error role_id-error"></span>
        </div>

        <button type="submit" id="btn-edit" class="btn btn-block btn-warning">Simpan</button>
    </form>
</x-shared.modal>

@push('scripts')
    <script>
        $(() => {
            // Data
            const State = {
                id: '',
                roleId: '',
            }
            // end Data

            // Mounted
            $(document).on('click', '.btn-show-edit', function() {
                const id = $(this).attr('id')
                State.id = id

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    type: 'get',
                    url: `users/${id}/edit`,
                    beforeSend() {
                        $('.msg-error').text('')
                        $('#modal-edit').modal('show')
                    },
                    success(res) {
                        if (res) {
                            State.roleId = res.role_id
                            fetchRole()

                            $('#name-edit').val(res.name)
                            $('#phone-edit').val(res.phone)
                            $('#email-edit').val(res.email)
                            $('#address-edit').val(res.address)
                        }
                    },
                })
            })

            $('#btn-edit').click((e) => {
                e.preventDefault()

                const id = State.id
                const name = $('#name-edit').val()
                const phone = $('#phone-edit').val()
                const email = $('#email-edit').val()
                const address = $('#address-edit').val()
                const roleId = $('#role-edit').val()

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
                    success(res) {
                        const {
                            message,
                            status
                        } = res
                        alert(message, status)
                        $('#modal-edit').modal('hide')
                        fetchUsers()
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
            // end Mounted

            // Methods
            function fetchRole() {
                $('#role-edit').select2({
                    placeholder: 'Pilih hak akses',
                    theme: 'bootstrap4'
                })

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    type: 'get',
                    url: `/dashboard/roles`,
                    beforeSend() {
                        $('#role-edit').children('option:not(:first)').remove()
                    },
                    success(res) {
                        if (res) {
                            res.forEach(role => {
                                let newOption = new Option(
                                    role.name, role.id, false, State.roleId === role.id ?? false
                                )
                                $('#role-edit').append(newOption)
                            })
                        }
                    },
                })
            }
            // end Methods
        })
    </script>
@endpush
