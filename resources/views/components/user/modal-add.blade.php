<x-shared.modal title="Tambah Akun user" id="modal-add">
    <form>
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Tulis nama">

            <span class="text-danger msg-error name-error"></span>
        </div>

        <div class="form-group">
            <label for="phone">Nomor HP</label>
            <input type="tel" id="phone" pattern="[0-9]*" name="phone" class="form-control"
                placeholder="Tulis nomor hp">

            <span class="text-danger msg-error phone-error"></span>
        </div>

        <div class="form-group">
            <label for="address">Alamat</label>
            <input type="address" name="address" id="address" class="form-control" placeholder="Tulis alamat">

            <span class="text-danger msg-error address-error"></span>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class=" form-control" placeholder="Tulis email">

            <span class="text-danger msg-error email-error"></span>
        </div>

        <div class="form-group">
            <label for="role">Hak Akses</label>
            <select class="select2" name="role_id" id="role">
                <option></option>
            </select>

            <span class="text-danger msg-error role_id-error"></span>
        </div>

        <button type="submit" id="btn-save" class="btn btn-block btn-warning">Simpan</button>
    </form>
</x-shared.modal>

@push('scripts')
    <script>
        $(() => {
            // Mounted
            fetchRole()

            $('#btn-add').click(() => {
                clearForm()
                $('.msg-error').text('')
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
                    url: "{{ route('dashboard.users.store') }}",
                    data: {
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
                        $('#modal-add').modal('hide')
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
                $('#role').select2({
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
                        $('#role').children('option:not(:first)').remove()
                    },
                    success(res) {
                        if (res) {
                            res.forEach(role => {
                                let newOption = new Option(
                                    role.name, role.id, false, false
                                )
                                $('#role').append(newOption)
                            })
                        }
                    },
                })
            }
            // end Methods
        })
    </script>
@endpush
