<x-auth-layout title="Login">
    @if (session('message'))
        <div class="alert alert-danger" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <x-shared.card>
        <div class="login-logo mb-4">
            <a href="/">
                <img src="{{ asset('img/logo-title.webp') }}" alt="Logo" style="width: 200px">
            </a>
        </div>

        <div class="divider"></div>

        <form>
            <div class="form-group">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email" id="email">
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

            <div class="row">
                <div class="col-8">
                    <p>
                        <a href="{{ route('password.request') }}" class="text-warning">Lupa kata sandi</a>
                    </p>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-warning btn-block" id="login">Login</button>
                </div>
            </div>
        </form>
    </x-shared.card>

    @prepend('scripts')
        <script>
            // Mounted
            $('#login').click((e) => {
                e.preventDefault()

                const email = $('#email').val()
                const password = $('#password').val()

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('login') }}",
                    data: {
                        email,
                        password
                    },
                    beforeSend() {
                        $('.msg-error').text('')
                    },
                    success(res) {
                        if (res.success) {
                            location.href = "{{ route('dashboard.dashboard') }}"
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
</x-auth-layout>
