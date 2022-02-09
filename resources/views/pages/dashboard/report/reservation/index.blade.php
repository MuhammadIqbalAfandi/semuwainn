<x-dashboard-layout title="Laporan Pemesanan">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Laporan Pemesanan">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Laporan Pemesanan</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-shared.card>
                <div class="row">
                    <div class="col-12 col-sm mb-3">
                        <form class="form-inline">
                            <div class="form-group" id="period-date">
                                <p class="mr-2 font-weight-normal">Periode: </p>
                                <input type="text" name="start" class="form-control">
                                <i class="fa fa-calendar-day mx-2"></i>
                                <input type="text" name="end" class="form-control">
                            </div>
                        </form>
                    </div>

                    <div class="col-auto mb-3">
                        <x-shared.button text="Export ke Excel" id="btn-export-xsl" faIcon="fa-file-excel">
                        </x-shared.button>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <table id="reservation-report-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Tgl. Pemesanan</th>
                                    <th>Tgl. Inap</th>
                                    <th>Lama Inap</th>
                                    <th>Jlh. Kamar</th>
                                    <th>Jlh. Tamu</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </x-shared.card>
        </x-shared.content>
    </x-shared.content-wrapper>

    @push('scripts')
        <script>
            // Mounted
            $('#reservation-report-table').DataTable({
                serverSide: true,
                searching: false,
                ajax: "{{ route('dashboard.report.reservations.reservations') }}",
                columns: [{
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'reservation_time',
                        name: 'reservation_time',
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
                        data: 'price',
                        name: 'price',
                    },
                    {
                        data: 'status',
                        name: 'status',
                    }
                ]
            })

            const elemPeriodDate = document.getElementById('period-date')
            const periodRagePicker = new DateRangePicker(elemPeriodDate, {})
            // end Mounted
        </script>
    @endpush
</x-dashboard-layout>
