<x-auth-layout title="Lupa Password">
    <x-shared.card>
        <div class="login-logo mb-4">
            <a href="/">
                <img src="{{ asset('img/logo-title.webp') }}" alt="Logo" style="width: 200px">
            </a>
        </div>

        <div
            style="width: 6rem; border: 1px solid #454d55; margin-bottom: 1.5rem; margin-left: auto; margin-right: auto;">
        </div>

        <p class="login-box-msg">Anda lupa kata sandi? tulis email anda untuk mereset kata sandi.</p>

        <p class="login-box-msg text-secondary" id="email-status"></p>

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

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-warning btn-block" id="request-password">Permintaan kata sandi
                        baru</button>
                </div>
            </div>
        </form>
    </x-shared.card>

    @prepend('scripts')
        <script>
            // Mounted
            $('#request-password').click((e) => {
                e.preventDefault()

                const email = $('#email').val()

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('password.email') }}",
                    data: {
                        email,
                    },
                    beforeSend() {
                        $('.msg-error').text('')
                    },
                    success(res) {
                        const {
                            success,
                            status
                        } = res
                        if (success) {
                            $('#email-status').text(status)
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
