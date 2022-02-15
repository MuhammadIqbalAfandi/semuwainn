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
                <x-report.period-filter></x-report.period-filter>

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
            const reportTable = $('#reservation-report-table').DataTable({
                serverSide: true,
                searching: false,
                ajax: {
                    url: "{{ route('dashboard.reports.reservations.reservations') }}",
                    data(d) {
                        d.startDate = $('[name="start"]').val()
                        d.endDate = $('[name="end"]').val()
                    },
                },
                columns: [{
                        data: 'name',
                    },
                    {
                        data: 'reservation_time'
                    },
                    {
                        data: 'checkin-checkout',
                    },
                    {
                        data: 'night-count',
                    },
                    {
                        data: 'room-count',
                    },
                    {
                        data: 'guest-count',
                    },
                    {
                        data: 'price'
                    },
                    {
                        data: 'status'
                    }
                ]
            })

            reportTable.on('draw', () => {
                if (reportTable.page.info().pages) {
                    $('#btn-export-xls').show()

                    // Set link export to excel
                    const startDate = $('[name="start"]').val()
                    const endDate = $('[name="end"]').val()
                    $('#btn-export-xls').attr('href',
                        `/dashboard/reports/reservations/exports?startDate=${startDate}&endDate=${endDate}`)
                } else {
                    $('#btn-export-xls').hide()
                }
            })

            $('#btn-show-report').click(() => {
                reportTable.draw()
            })
            // end Mounted
        </script>
    @endpush
</x-dashboard-layout>
