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
            <x-shared.card title="Daftar Tamu">
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NIK / No. HP / Email</th>
                                    <th>Nama</th>
                                    <th>Jlh. Pemesanan</th>
                                    <th>Tanggal Diperbaharui</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </x-shared.card>

            <x-guest.modal-edit></x-guest.modal-edit>

            <x-guest.modal-delete></x-guest.modal-delete>
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
                ajax: 'guests/guests',
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
                $('[name="nik"]').val('')
                $('[name="name"]').val('')
                $('[name="phone"]').val('')
                $('[name="email"]').val('')
                $('[name="address"]').val('')
            }

            function fetchGuest() {
                $('.table').DataTable().ajax.reload()
            }
            // end Methods
        </script>
    @endpush
</x-dashboard-layout>
