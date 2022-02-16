<x-dashboard-layout title="Tipe Kamar">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Tipe Kamar">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item active">Tipe Kamar</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-shared.card>
                <div class="row mb-2">
                    <div class="col">
                        @can('isAdmin')
                            <a href="{{ route('dashboard.room-types.create') }}">
                                <x-shared.button text="Tambah Tipe Kamar" id="btn-add" faIcon="fa-plus"
                                    class="float-right">
                                </x-shared.button>
                            </a>
                        @endcan
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Tipe Kamar</th>
                                    <th>Fasilitas</th>
                                    <th>Harga</th>
                                    <th>Jumlah Kamar</th>
                                    <th>Jumlah tamu</th>
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

            <x-dashboard.room-type.modal-delete></x-dashboard.room-type.modal-delete>
        </x-shared.content>
    </x-shared.content-wrapper>

    @prepend('scripts')
        <script>
            // Mounted
            $('.table').DataTable({
                serverSide: true,
                ajax: "{{ route('dashboard.room-types.room-types') }}",
                columns: [{
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'facility',
                        name: 'facility',
                    },
                    {
                        data: 'price',
                        name: 'price',
                    },
                    {
                        data: 'room-count',
                        name: 'room-count',
                    },
                    {
                        data: 'guest-count',
                        name: 'guest-count',
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
            function fetchRoomTypes() {
                $('.table').DataTable().ajax.reload()
            }
            // end Methods
        </script>
    @endprepend
</x-dashboard-layout>
