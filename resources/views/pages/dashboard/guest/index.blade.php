<x-dashboard-layout title="Kamar">
    <!-- Guest List -->
    <x-dashboard-content-wrapper>
        <x-dashboard-content-header title="Kamar">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item active">Tamu</li>
            </x-slot>
        </x-dashboard-content-header>

        <x-dashboard-content>
            <x-dashboard-card title="Daftar Kamar">
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NIK / No. HP / Email</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Jlh. Pemesanan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </x-dashboard-card>
        </x-dashboard-content>
    </x-dashboard-content-wrapper>

    <!-- Modal Edit -->
    <x-dashboard-modal title="Ubah Data Tamu" id="modal-edit">
        <form>
            <!-- guest Id -->
            <input type="hidden" name="guest_id" id="guest-id" value="{{ old('guest_id') }}">

            <!-- Nik -->
            <div class="form-group">
                <label for="nik">Nik</label>
                <input type="text" name="nik" id="nik" value="{{ old('nik') }}" class="form-control"
                    placeholder="Tulis nik disini">

                <span class="nik-add-error msg-error text-danger"></span>
            </div>

            <!-- Name -->
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control"
                    placeholder="Tulis nama disini">

                <span class="name-error msg-error text-danger"></span>
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label for="phone">Nomor HP</label>
                <input type="tel" pattern="[0-9]*" id="phone" name="phone" value="{{ old('phone') }}"
                    class="form-control" placeholder="Tulis nomor hp disini">

                <span class="phone-error msg-error text-danger"></span>
            </div>

            <!-- Address -->
            <div class="form-group">
                <label for="address">Alamat</label>
                <input type="address" name="address" id="address" value="{{ old('address') }}" class="form-control"
                    placeholder="Tulis alamat disini">

                <span class="address-error msg-error text-danger"></span>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control"
                    placeholder="Tulis email disini">

                <span class="email-error msg-error text-danger"></span>
            </div>

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
                <!-- Guest Id -->
                <input type="hidden" name="guest_id" id="guest-id-delete">
                <button type="submit" id="btn-delete" class="btn btn-warning float-right btn-rounded w-140">Ya</button>
            </form>
        </x-slot>
    </x-dashboard-modal>

    <x-slot name="script">
        <script>
            $(() => {
                // Mounted
                const guestTable = $('.table').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                })

                fetchGuest()

                $(document).on('click', '.btn-show-edit', function() {

                    const id = $(this).attr('id')

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'get',
                        url: `guest/${id}/edit`,
                        beforeSend() {
                            $('.msg-error').text('')
                            $('.modal-title').text('Ubah Data Tamu')
                            $('#btn-edit').show()
                            $('#modal-edit').modal('show')
                        },
                        success(res) {
                            $('#guest-id').val(res.guest.id)
                            $('#name').val(res.guest.name)
                            $('#nik').val(res.guest.nik)
                            $('#phone').val(res.guest.phone)
                            $('#address').val(res.guest.address)
                            $('#email').val(res.guest.email)
                        }
                    })

                    $('#modal-add').modal('show')
                })

                $('#btn-edit').click((e) => {
                    e.preventDefault()

                    const id = $('#guest-id').val()
                    const name = $('#name').val()
                    const nik = $('#nik').val()
                    const phone = $('#phone').val()
                    const address = $('#address').val()
                    const email = $('#email').val()

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'patch',
                        url: `guest/${id}`,
                        data: {
                            id,
                            name,
                            nik,
                            phone,
                            address,
                            email,
                        },
                        success(res) {
                            alert(res.message, res.status)
                            $('#modal-edit').modal('hide')
                            fetchGuest()
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
                    $('#guest-id-delete').val(id)

                    $('#modal-delete').modal('show')
                })

                $('#btn-delete').click((e) => {
                    e.preventDefault()

                    const id = $('#guest-id-delete').val()
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'delete',
                        url: `guest/${id}`,
                        success(res) {
                            alert(res.message, res.status)
                            $('#modal-delete').modal('hide')
                            fetchGuest()
                        },
                    })
                })
                // end Mounted

                // Methods
                function clearForm() {
                    $('#nik-add').val('')
                    $('#name-add').val('')
                    $('#phone-add').val('')
                    $('#email-add').val('')
                    $('#address-add').val('')
                }

                function fetchGuest() {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: 'get',
                        url: 'guest/guests',
                        success(res) {
                            if (res.guests) {
                                guestTable.clear().draw()

                                res.guests.forEach(guest => {
                                    let btnAction = `
                                        <!-- Button Edit -->
                                        <i class="fas fa-edit mr-1 btn-show-edit text-primary" id="${guest.id}">
                                        </i>

                                        <!-- Button Delete -->
                                        <i class="fas fa-trash-alt btn-show-delete text-danger" id="${guest.id}">
                                        </i>
                                    `

                                    guestTable.row.add([
                                        `
                                            <span class="d-block">${guest.nik}</span>
                                            <span class="d-block text-secondary">${guest.phone}</span>
                                            <span class="d-block text-secondary">${guest.email}</span>
                                        `,
                                        guest.name,
                                        guest.address,
                                        guest.reservations.length,
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
