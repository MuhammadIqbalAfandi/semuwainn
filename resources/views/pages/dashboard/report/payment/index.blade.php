<x-dashboard-layout title="Laporan Keuangan">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Laporan Keuangan">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Laporan Keuangan</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-shared.card>
                <x-dashboard.report.period-filter></x-dashboard.report.period-filter>

                <div class="row">
                    <div class="col">
                        <table id="payment-report-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Pemasukan</th>
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
            const reportTable = $('#payment-report-table').DataTable({
                serverSide: true,
                searching: false,
                ajax: {
                    url: "{{ route('dashboard.reports.payments.payments') }}",
                    data(d) {
                        d.startDate = $('[name="start"]').val()
                        d.endDate = $('[name="end"]').val()
                    },
                },
                columns: [{
                        data: 'date'
                    },
                    {
                        data: 'income',
                    },
                    {
                        data: 'status',
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
                        `/dashboard/reports/payments/exports?startDate=${startDate}&endDate=${endDate}`)
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
