<x-dashboard-layout title="Daftar Pemesanan Kamar">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Daftar Pemesanan Kamar">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Daftar Pemesanan Kamar</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-shared.card>
                <div class="row">
                    <div class="col">
                        <table id="reservation-list-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        <span class="d-block">NIK Pemesan /</span>
                                        <span class="d-block">No. Order /</span>
                                        <span class="d-block">Tgl. Order</span>
                                    </th>
                                    <th>Tgl. Inap</th>
                                    <th>Lama Inap</th>
                                    <th>Jlh. Kamar</th>
                                    <th>Jumlah Tamu</th>
                                    <th>Status</th>
                                    @canany(['isAdmin', 'isWaiter'])
                                        <th>Aksi</th>
                                    @endcanany
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

                <x-reservation.index.modal-edit-status></x-reservation.index.modal-edit-status>
            </x-shared.card>
        </x-shared.content>
    </x-shared.content-wrapper>

    @prepend('scripts')
        <script>
            // Mounted
            @if (session('success'))
                alert("{{ session('success') }}", 'success')
            @elseif (session('failed'))
                alert("{{ session('failed') }}", 'failed')
            @endif

            $('#reservation-list-table').DataTable({
                serverSide: true,
                ajax: "{{ route('dashboard.reservations.reservations') }}",
                columns: [{
                        data: 'order',
                        name: 'order',
                    },
                    {
                        data: 'checkin-checkout',
                        name: 'checkin-checkout',
                    },
                    {
                        data: 'night-count',
                        name: 'night-count',
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
                        data: 'status',
                        name: 'status'
                    },
                    @canany(['isAdmin', 'isWaiter'])
                        {
                        data: 'actions',
                        name: 'actions'
                        }
                    @endcanany
                ],
            })
            // end Mounted

            // Methods
            function fetchReservation() {
                $('#reservation-list-table').DataTable().ajax.reload()
            }
            // end Methods
        </script>
    @endprepend
</x-dashboard-layout>
