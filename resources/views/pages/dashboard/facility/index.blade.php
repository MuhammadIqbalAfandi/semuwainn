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
            <x-shared.card title="Daftar Fasilitas">
                <div class="row mb-2">
                    <div class="col">
                        <button type="button" id="btn-add" class="btn btn-sm btn-warning float-right"
                            data-toggle="modal">
                            <i class="fa fa-plus"></i>
                        </button>
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </x-shared.card>

            <x-facility.modal-add></x-facility.modal-add>

            <x-facility.modal-edit></x-facility.modal-edit>

            <x-facility.modal-delete></x-facility.modal-delete>
        </x-shared.content>
    </x-shared.content-wrapper>

    @push('scripts')
        <script>
            // Mounted
            $('.table').DataTable({
                stateSave: true,
                responsive: true,
                processing: true,
                serverSide: true,
                scrollX: true,
                autoWidth: false,
                ajax: 'facilities/facilities',
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
                $('[name="name"]').val('')
            }

            function fetchFacilities() {
                $('.table').DataTable().ajax.reload()
            }
            // end Methods
        </script>
    @endpush
</x-dashboard-layout>
