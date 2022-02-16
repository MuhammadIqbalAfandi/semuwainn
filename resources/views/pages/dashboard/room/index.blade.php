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
            <x-shared.card>
                <div class="row mb-2">
                    <div class="col">
                        @can('isAdmin')
                            <x-shared.button text="Tambah Kamar" id="btn-add" faIcon="fa-plus" class="float-right">
                            </x-shared.button>
                        @endcan
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
                                    @can('isAdmin')
                                        <th>Aksi</th>
                                    @endcan
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </x-shared.card>

            <x-dashboard.room.modal-add></x-dashboard.room.modal-add>

            <x-dashboard.room.modal-edit></x-dashboard.room.modal-edit>

            <x-dashboard.room.modal-delete></x-dashboard.room.modal-delete>
        </x-shared.content>
    </x-shared.content-wrapper>

    @prepend('scripts')
        <script>
            // Mounted
            $('.table').DataTable({
                serverSide: true,
                ajax: "{{ route('dashboard.rooms.rooms') }}",
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
