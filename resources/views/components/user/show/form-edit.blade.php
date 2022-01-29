<form>
    <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Tulis nama"
            value="{{ $user->name }}">

        <span class="text-danger msg-error name-error"></span>
    </div>

    <div class="form-group">
        <label for="phone">Nomor HP</label>
        <input type="tel" id="phone" pattern="[0-9]*" name="phone" class="form-control" placeholder="Tulis nomor hp"
            value="{{ $user->phone }}">

        <span class="text-danger msg-error phone-error"></span>
    </div>

    <div class="form-group">
        <label for="address">Alamat</label>
        <input type="address" name="address" id="address" class="form-control" placeholder="Tulis alamat"
            value="{{ $user->address }}">

        <span class="text-danger msg-error address-error"></span>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class=" form-control" placeholder="Tulis email"
            value="{{ $user->email }}">

        <span class="text-danger msg-error email-error"></span>
    </div>

    <div class="form-group">
        <label for="gender">Jenis Kelamin</label>
        <select class="select2 form-control" name="gender_id" id="gender">
            <option></option>
        </select>

        <span class="text-danger msg-error gender_id-error"></span>
    </div>

    @can('isAdmin')
        <div class="form-group">
            <label for="role">Hak Akses</label>
            <select class="select2 form-control" name="role_id" id="role">
                <option></option>
            </select>

            <span class="text-danger msg-error role_id-error"></span>
        </div>
    @endcan

    <button type="submit" id="btn-save" class="btn btn-block btn-warning">Simpan</button>
</form>

@push('scripts')
    <script>
        $(() => {
            // Mounted
            fetchRole()
            fetchGender()

            $('#btn-save').click((e) => {
                e.preventDefault()

                const id = {{ $user->id }}
                const name = $('#name').val()
                const phone = $('#phone').val()
                const email = $('#email').val()
                const address = $('#address').val()
                const genderId = $('#gender').val()
                const roleId = $('#role').val()

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    type: 'patch',
                    url: "{{ route('dashboard.users.update', $user->id) }}",
                    data: {
                        id,
                        name,
                        phone,
                        email,
                        address,
                        gender_id: genderId,
                        role_id: roleId,
                    },
                    beforeSend() {
                        $('.msg-error').text('')
                    },
                    success(res) {
                        const {
                            message,
                            status
                        } = res
                        alert(message, status)
                        setUser()
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
            function fetchGender() {
                $('#gender').select2({
                    placeholder: 'Pilih jenis kelamin',
                    theme: 'bootstrap4'
                })

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    type: 'get',
                    url: "{{ route('dashboard.users.genders') }}",
                    beforeSend() {
                        $('#gender').children('option:not(:first)').remove()
                    },
                    success(res) {
                        if (res) {
                            res.forEach(gender => {
                                let newOption = new Option(
                                    gender.gender, gender.id, false,
                                    {{ auth()->user()->gender_id }} === gender.id ?? false
                                )
                                $('#gender').append(newOption)
                            })
                        }
                    },
                })
            }

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
                    url: "{{ route('dashboard.users.roles') }}",
                    beforeSend() {
                        $('#role').children('option:not(:first)').remove()
                    },
                    success(res) {
                        if (res) {
                            res.forEach(role => {
                                let newOption = new Option(
                                    role.name, role.id, false,
                                    {{ $user->role_id }} === role.id ?? false
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
