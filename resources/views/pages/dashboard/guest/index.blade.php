<x-dashboard-layout title="Tamu">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Tamu">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item active">Tamu</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-shared.card>
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NIK / No. HP / Email</th>
                                    <th>Nama</th>
                                    <th>Jlh. Pemesanan</th>
                                    <th>Tanggal Diperbaharui</th>
                                    @can('isAdmin')
                                        <th>Aksi</th>
                                    @endcan
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </x-shared.card>

            <x-dashboard.guest.modal-edit></x-dashboard.guest.modal-edit>

            <x-dashboard.guest.modal-delete></x-dashboard.guest.modal-delete>
        </x-shared.content>
    </x-shared.content-wrapper>

    @prepend('scripts')
        <script>
            // Mounted
            $('.table').DataTable({
                serverSide: true,
                ajax: "{{ route('dashboard.guests.guests') }}",
                columns: [{
                        data: 'nik',
                        name: 'nik'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'booking',
                        name: 'booking'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    @can('isAdmin')
                        {
                        data: 'actions',
                        name: 'actions'
                        }
                    @endcan
                ],
            })
            // end Mounted

            // Methods
            function fetchGuest() {
                $('.table').DataTable().ajax.reload()
            }
            // end Methods
        </script>
    @endprepend
</x-dashboard-layout>
