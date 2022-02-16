<x-shared.modal id="modal-edit" title="Ubah Data Tamu">
    <form>
        <div class="form-group">
            <label for="nik">Nik</label>
            <input type="text" name="nik" id="nik" class="form-control" placeholder="Tulis nik">

            <span class="nik-error msg-error text-danger"></span>
        </div>

        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Tulis nama">

            <span class="name-error msg-error text-danger"></span>
        </div>

        <div class="form-group">
            <label for="phone">Nomor HP</label>

            <input type="tel" pattern="[0-9]*" id="phone" name="phone" class="form-control"
                placeholder="Tulis nomor hp">

            <span class="phone-error msg-error text-danger"></span>
        </div>

        <div class="form-group">
            <label for="email">Email</label>

            <input type="email" name="email" id="email" class="form-control" placeholder="Tulis email">

            <span class="email-error msg-error text-danger"></span>
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
                    url: `guests/${id}/edit`,
                    beforeSend() {
                        $('.msg-error').text('')
                        $('#modal-edit').modal('show')
                    },
                    success(res) {
                        $('#guest-id').val(res.guest.id)
                        $('#name').val(res.guest.name)
                        $('#nik').val(res.guest.nik)
                        $('#phone').val(res.guest.phone)
                        $('#email').val(res.guest.email)
                    }
                })
            })

            $('#btn-edit').click((e) => {
                e.preventDefault()

                const id = State.id
                const name = $('#name').val()
                const nik = $('#nik').val()
                const phone = $('#phone').val()
                const email = $('#email').val()

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'patch',
                    url: `guests/${id}`,
                    data: {
                        id,
                        name,
                        nik,
                        phone,
                        email,
                    },
                    success(res) {
                        const {
                            message,
                            status
                        } = res
                        alert(message, status)
                        $('#modal-edit').modal('hide')
                        fetchGuest()
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
        })
    </script>
@endpush
