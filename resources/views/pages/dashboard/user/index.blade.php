<x-dashboard-layout title="Akun User">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Akun User">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item active">Akun User</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-shared.card>
                <div class="row mb-2">
                    <div class="col">
                        <x-shared.button text="Tambah User" id="btn-add" faIcon="fa-plus" class="float-right">
                        </x-shared.button>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No. HP / Email</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Hak Akses</th>
                                    <th>Tanggal Diperbaharui</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </x-shared.card>

            <x-dashboard.user.index.modal-add></x-dashboard.user.index.modal-add>

            <x-dashboard.user.index.modal-block></x-dashboard.user.index.modal-block>
        </x-shared.content>
    </x-shared.content-wrapper>

    @push('scripts')
        <script>
            // Mounted
            $('.table').DataTable({
                serverSide: true,
                ajax: "{{ route('dashboard.users.users') }}",
                columns: [{
                        data: 'phone-email',
                        name: 'phone-email',
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'gender',
                        name: 'gender',
                    },
                    {
                        data: 'address',
                        name: 'address',
                    },
                    {
                        data: 'role',
                        name: 'role',
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
            })
            // end Mounted

            // Methods
            function clearForm() {
                $('[name="name"]').val('')
                $('[name="email"]').val('')
                $('[name="phone"]').val('')
                $('[name="address"]').val('')
                $('[name="role_id"]').val(null).trigger('change');
            }

            function fetchUsers() {
                $('.table').DataTable().ajax.reload()
            }
            // end Methods
        </script>
    @endpush
</x-dashboard-layout>
