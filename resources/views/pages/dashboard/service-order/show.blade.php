<x-dashboard-layout title="Tambah Layanan">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Tambah Layanan">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.reservations.index') }}"
                        class="text-warning">Daftar
                        Pemesanan Kamar</a></li>
                <li class="breadcrumb-item active">Tambah Layanan</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-shared.card title="Tambah Layanan">
                <form>
                    <input id="reservation-id" type="hidden" value="{{ $reservationId }}" />
                </form>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nama Layanan</th>
                            <th>Kuantitas</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>

                <div class="row mt-3">
                    <div class="col d-flex justify-content-end">
                        <button type="button" class="btn btn-sm btn-warning" id="btn-save"><i class="fa fa-save"></i>
                            Simpan pesanan</button>
                    </div>
                </div>
            </x-shared.card>
        </x-shared.content>
    </x-shared.content-wrapper>

    @push('scripts')
        <script>
            // Mounted
            const table = $('.table').DataTable({
                paging: false,
                searching: false,
                ordering: false,
                info: false,
                autoWidth: false,
                scrollX: true,
                responsive: true,
            })
            // end Mounted
        </script>
    @endpush
</x-dashboard-layout>
