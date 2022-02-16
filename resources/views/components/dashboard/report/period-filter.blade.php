<div class="row mb-3">
    <div class="col-md col-sm-12">
        <form id="period-date" class="form-inline">
            <div class="form-group">
                <label class="mr-1 font-weight-normal">Periode:</label>
                <input type="text" name="start" class="form-control">
            </div>

            <div class="form-group">
                <label><i class="fa fa-calendar-day mx-1"></i></label>
                <input type="text" name="end" class="form-control">
            </div>
        </form>
    </div>

    <div class="col-md-auto col-sm-12">
        <x-shared.button text="Tampilkan Data" id="btn-show-report" faIcon="fa-eye">
        </x-shared.button>

        <a id="btn-export-xls">
            <x-shared.button text="Export ke Excel" faIcon="fa-file-excel">
            </x-shared.button>
        </a>
    </div>
</div>

@push('scripts')
    <script>
        // Mounted
        $('#btn-export-xls').hide()

        const elemPeriodDate = document.getElementById('period-date')
        const periodRagePicker = new DateRangePicker(elemPeriodDate, {
            language: 'id',
            format: 'dd/mm/yyyy',
        })
        // end Mounted
    </script>
@endpush
