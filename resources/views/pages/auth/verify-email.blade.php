<x-guest-layout title="Lupa Password">
    <x-shared.card>
        <div class="login-logo mb-4">
            <a href="/">
                <img src="{{ asset('img/logo-title.webp') }}" alt="Logo" style="width: 200px">
            </a>
        </div>

        <div
            style="width: 6rem; border: 1px solid #454d55; margin-bottom: 1.5rem; margin-left: auto; margin-right: auto;">
        </div>

        <p class="login-box-msg" id="send-notification">Email verifikasi telah terkirim ke email Anda yang Anda berikan
            saat pendaftaran, jika email verifikasi tidak terkirim silahkan cek spam jika tidak ada juga, Anda bisa
            mengirim ulang melalui
            tombol dibawah!</p>

        <p class="login-box-msg text-secondary" id="resend-notification"></p>

        <form>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-warning btn-block" id="resend-verification-email">Kirim ulang
                        email verifikasi</button>
                </div>

            </div>
        </form>

        <form method="post" action="{{ route('logout') }}">
            @csrf
            <div class="col-12 text-center mt-2">
                <button type="submit" class="btn btn-link text-warning">Logout</button>
            </div>
        </form>
    </x-shared.card>

    @prepend('scripts')
        <script>
            // Mounted
            $('#resend-verification-email').click((e) => {
                e.preventDefault()

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('verification.send') }}",
                    success(res) {
                        const {
                            success,
                            status
                        } = res
                        if (success) {
                            if (status === 'verification-link-sent') {
                                $('#resend-notification').text(
                                    'Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.'
                                )
                            }
                        }
                    },
                })
            })
            // end Mounted
        </script>
    @endprepend
</x-guest-layout>
