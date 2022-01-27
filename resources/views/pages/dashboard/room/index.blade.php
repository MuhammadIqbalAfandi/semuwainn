<x-dashboard-layout title="Kamar">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Kamar">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item active">Kamar</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-shared.card :cardHeader="false" class="card-outline">
                <div class="row mb-2">
                    <div class="col">
                        <button type="button" id="btn-add" class="btn btn-sm btn-warning float-right">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nomor Kamar</th>
                                    <th>Jenis Kamar</th>
                                    <th>Status</th>
                                    <th>Tanggal Diperbaharui</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </x-shared.card>

            <x-room.modal-add></x-room.modal-add>

            <x-room.modal-edit></x-room.modal-edit>

            <x-room.modal-delete></x-room.modal-delete>
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
                ajax: 'rooms/rooms',
                columns: [{
                        data: 'room_number',
                        name: 'room_number',
                    },
                    {
                        data: 'room-type',
                        name: 'room-type',
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'actions',
                        name: 'actions'
                    }
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
            function clearForm() {
                $('[name="room-number"]').val('')
                $('[name="room-type-id"]').val(null).trigger('change');
            }

            function fetchRooms() {
                $('.table').DataTable().ajax.reload()
            }
            // end Methods
        </script>
    @endprepend
</x-dashboard-layout>
