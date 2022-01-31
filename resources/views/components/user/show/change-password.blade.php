<form>
    <div class="form-group">
        <label for="current-password">Kata Sandi Lama</label>
        <input class="form-control" type="password" name="current_password" id="current-password"
            placeholder="Kata sandi lama">

        <span class="text-danger msg-error current_password-error"></span>
    </div>

    <div class="form-group">
        <label for="password">Kata Sandi Baru</label>
        <input class="form-control" type="password" name="password" id="password" placeholder="Kata sandi baru">

        <span class="text-danger msg-error password-error"></span>
    </div>

    <div class="form-group">
        <label for="password-confirmation">Konfirmasi Kata Sandi</label>
        <input class="form-control" type="password" name="password_confirmation" id="password-confirmation"
            placeholder="Konfirmasi kata sandi">

        <span class="text-danger msg-error password_confirmation-error"></span>
    </div>

    <button class="btn btn-block btn-warning" type="submit" id="btn-change-password">Simpan</button>
</form>

@push('scripts')
    <script>
        $(() => {
            // Mounted
            $('#btn-change-password').click((e) => {
                e.preventDefault()

                const currentPassword = $('#current-password').val()
                const password = $('#password').val()
                const passwordConfirmation = $('#password-confirmation').val()

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('dashboard.users.change-password') }}",
                    data: {
                        current_password: currentPassword,
                        password,
                        password_confirmation: passwordConfirmation,
                    },
                    beforeSend() {
                        $('.msg-error').text('')
                    },
                    success(res, _, jqXHR) {
                        const {
                            message,
                            status
                        } = res
                        const statusCode = jqXHR.status

                        if (statusCode === 201) {
                            alert(message, status)
                            clearForm()
                        } else if (statusCode === 202) {
                            $('.current_password-error').text(message)
                        }
                    },
                    error(res) {
                        const {
                            errors,
                            message,
                        } = res.responseJSON
                        if (status === 'failed') {
                            alert(message, status)
                        } else {
                            for (const key in errors) {
                                $(`.${key}-error`).text(errors[key])
                            }
                        }
                    },
                })
            })
            // end Mounted

            // Methods
            function clearForm() {
                $('#current-password').val('')
                $('#password').val('')
                $('#password-confirmation').val('')
            }
            // end Methods
        })
    </script>
@endpush
