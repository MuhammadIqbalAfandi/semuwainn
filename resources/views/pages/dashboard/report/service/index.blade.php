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
                <x-dashboard.report.period-filter></x-dashboard.report.period-filter>

                <div class="row">
                    <div class="col">
                        <table id="service-report-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tgl. Pemesanan</th>
                                    <th>Nama Layanan</th>
                                    <th>Harga</th>
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
            const reportTable = $('#service-report-table').DataTable({
                serverSide: true,
                searching: false,
                ajax: {
                    url: "{{ route('dashboard.reports.services.services') }}",
                    data(d) {
                        d.startDate = $('[name="start"]').val()
                        d.endDate = $('[name="end"]').val()
                    },
                },
                columns: [{
                        data: 'order_time'
                    },
                    {
                        data: 'service_name',
                    },
                    {
                        data: 'price',
                    },
                ]
            })

            reportTable.on('draw', () => {
                if (reportTable.page.info().pages) {
                    $('#btn-export-xls').show()

                    // Set link export to excel
                    const startDate = $('[name="start"]').val()
                    const endDate = $('[name="end"]').val()
                    $('#btn-export-xls').attr('href',
                        `/dashboard/reports/services/exports?startDate=${startDate}&endDate=${endDate}`)
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
