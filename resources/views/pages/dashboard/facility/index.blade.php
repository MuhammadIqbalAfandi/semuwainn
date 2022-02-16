<x-dashboard-layout title="Fasilitas">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Fasilitas">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item active">Fasilitas</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-shared.card>
                <div class="row mb-2">
                    <div class="col">
                        @can('isAdmin')
                            <x-shared.button text="Tambah Fasilitas" id="btn-add" faIcon="fa-plus" class="float-right">
                            </x-shared.button>
                        @endcan
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Fasilitas</th>
                                    <th>Jumlah Kamar</th>
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

            <x-dashboard.facility.modal-add></x-dashboard.facility.modal-add>

            <x-dashboard.facility.modal-edit></x-dashboard.facility.modal-edit>

            <x-dashboard.facility.modal-delete></x-dashboard.facility.modal-delete>
        </x-shared.content>
    </x-shared.content-wrapper>

    @push('scripts')
        <script>
            // Mounted
            $('.table').DataTable({
                serverSide: true,
                ajax: "{{ route('dashboard.facilities.facilities') }}",
                columns: [{
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'room-count',
                        name: 'room-count',
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
                $('[name="name"]').val('')
            }

            function fetchFacilities() {
                $('.table').DataTable().ajax.reload()
            }
            // end Methods
        </script>
    @endpush
</x-dashboard-layout>
