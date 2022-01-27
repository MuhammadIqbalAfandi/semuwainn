<x-dashboard-layout title="Pengaturan Akun User">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Pengaturan Akun User">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item active">Pengaturan Akun User</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <div class="row">
                <div class="col-3">
                    <x-shared.card :cardHeader="false" class="card-outline">
                        <section>
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/avatar1.png') }}"
                                    alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center" id="name-text"></h3>
                            <p class="text-muted text-center" id="role-name-text"></p>
                        </section>

                        <div class="divider"></div>

                        <section>
                            <section>
                                <strong><i class="fas fa-clock mr-1"></i>Dibuat pada</strong>
                                <p class="text-muted" id="created-text"></p>
                            </section>

                            <hr>

                            <section>
                                <strong><i class="fas fa-phone-alt mr-1"></i>Phone</strong>
                                <p class="text-muted" id="phone-text"></p>
                            </section>

                            <hr>

                            <section>
                                <strong><i class="fas fa-at mr-1"></i>Email</strong>
                                <p class="text-muted" id="email-text"></p>
                            </section>

                            <hr>

                            <section>
                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                                <p class="text-muted" id="address-text"></p>
                            </section>
                        </section>
                    </x-shared.card>
                </div>

                <div class="col-9">
                    <x-user.form-edit></x-user.form-edit>
                </div>
            </div>
        </x-shared.content>
    </x-shared.content-wrapper>

    @prepend('scripts')
        <script>
            // Mounted
            setUser()
            // end Mounted

            // Methods
            function setUser() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    type: 'get',
                    url: "{{ route('dashboard.users.edit', auth()->user()->id) }}",
                    success(res) {
                        $('#created-text').text(res.created_at)
                        $('#name-text').text(res.name)
                        $('#user-panel-name').text(res.name)
                        $('#role-name-text').text(res.role.name)
                        $('#phone-text').text(res.phone)
                        $('#email-text').text(res.email)
                        $('#address-text').text(res.address)
                    },
                })
            }
            // end Methods
        </script>
    @endprepend
</x-dashboard-layout>
