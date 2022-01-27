<x-dashboard-layout title="Layanan">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Layanan">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a></li>
                <li class="breadcrumb-item active">Layanan</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-shared.card :cardHeader="false" class="card-outline">
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
                                    <th>Nama Layanan</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Tanggal Diperbaharui</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </x-shared.card>
        </x-shared.content>
    </x-shared.content-wrapper>

    <x-service.modal-add></x-service.modal-add>

    <x-service.modal-edit></x-service.modal-edit>

    <x-service.modal-delete></x-service.modal-delete>

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
                ajax: 'services/services',
                columns: [{
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'service_unit_id',
                        name: 'service_unit_id',
                    },
                    {
                        data: 'price',
                        name: 'price',
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
            function fetchServices() {
                $('.table').DataTable().ajax.reload()
            }

            function clearForm() {
                $('[name="name"]').val('')
                $('[name="service_unit_id"]').val(null).trigger('change')
                $('[name="price"]').val('')
            }
            // end Methods
        </script>
    @endprepend
</x-dashboard-layout>
