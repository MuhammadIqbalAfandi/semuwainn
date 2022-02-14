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
                <div class="row mb-3">
                    <div class="col">
                        <form>
                            <div id="period-date" class="form-inline">
                                <div class="form-group">
                                    <label class="font-weight-normal">Periode: </label>
                                    <input type="text" name="start" class="form-control">
                                </div>

                                <i class="fa fa-calendar-day"></i>

                                <div class="form-group">
                                    <input type="text" name="end" class="form-control">
                                </div>

                                <x-shared.button text="Tampilkan Data" id="btn-show-report" faIcon="fa-eye">
                                </x-shared.button>

                                <x-shared.button text="Export ke Excel" id="btn-export-xsl" faIcon="fa-file-excel">
                                </x-shared.button>
                            </div>
                        </form>
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
            $('#btn-export-xsl').hide()

            const reportTable = $('#reservation-report-table').DataTable({
                serverSide: true,
                searching: false,
                ajax: {
                    url: "{{ route('dashboard.report.reservations.reservations') }}",
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
                    $('#btn-export-xsl').show()
                } else {
                    $('#btn-export-xsl').hide()
                }
            })

            const elemPeriodDate = document.getElementById('period-date')
            const periodRagePicker = new DateRangePicker(elemPeriodDate, {
                language: 'id',
                format: 'dd/mm/yyyy',
            })


            $('#btn-show-report').click(() => {
                reportTable.draw()
            })
            // end Mounted
        </script>
    @endpush
</x-dashboard-layout>
