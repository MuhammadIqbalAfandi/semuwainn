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
            <x-shared.card :cardHeader="false" class="card-outline">
                <div class="row mb-2">
                    <div class="col">
                        @can('isAdmin')
                            <a href="{{ route('dashboard.room-types.create') }}">
                                <button type="button" id="btn-add" class="btn btn-sm btn-warning float-right">
                                    <i class="fa fa-plus"></i>
                                </button>
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

            <x-room-type.modal-delete></x-room-type.modal-delete>
        </x-shared.content>
    </x-shared.content-wrapper>

    @prepend('scripts')
        <script>
            // Mounted
            $('.table').DataTable({
                stateSave: true,
                responsive: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                autoWidth: false,
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
                language: {
                    processing: '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...',
                    emptyTable: "Data tidak tersedia!",
                    zeroRecords: "Data tidak ditemukan",
                    search: "Cari:",
                },
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
