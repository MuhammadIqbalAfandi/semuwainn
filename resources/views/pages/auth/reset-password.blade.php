<x-guest-layout title="Login">
    <x-shared.card :cardHeader="false">
        <div class="login-logo mb-4">
            <a href="/">
                <img src="{{ asset('img/logo-title.webp') }}" alt="Logo" style="width: 200px">
            </a>
        </div>

        <div
            style="width: 6rem; border: 1px solid #454d55; margin-bottom: 1.5rem; margin-left: auto; margin-right: auto;">
        </div>

        <form>
            <div class="form-group">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email" id="email"
                        value="{{ $email }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>

                <span class="email-error msg-error text-danger"></span>
            </div>

            <div class="form-group">
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Kata Sandi" name="password"
                        id="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <span class="password-error msg-error text-danger"></span>
            </div>

            <div class="form-group">
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Konfirmasi Kata Sandi"
                        name="password_confirmation" id="password_confirmation">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <span class="password_confirmation-error msg-error text-danger"></span>
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-warning btn-block" id="reset-password">Reset kata
                        sandi</button>
                </div>
            </div>
        </form>
    </x-shared.card>

    @prepend('scripts')
        <script>
            // Mounted
            $('#reset-password').click((e) => {
                e.preventDefault()

                const email = $('#email').val()
                const password = $('#password').val()
                const passwordConfirmation = $('#password_confirmation').val()
                const token = '{{ $token }}'

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('password.update') }}",
                    data: {
                        email,
                        password,
                        password_confirmation: passwordConfirmation,
                        token,
                    },
                    beforeSend() {
                        $('.msg-error').text('')
                    },
                    success(res) {
                        if (res.success) {
                            location.href = "{{ route('login') }}"
                        }
                    },
                    error(res) {
                        const {
                            errors,
                            message,
                        } = res.responseJSON
                        for (const key in errors) {
                            $(`.${key}-error`).text(errors[key])
                        }
                    }
                })
            })
            // end Mounted
        </script>
    @endprepend
</x-guest-layout>
