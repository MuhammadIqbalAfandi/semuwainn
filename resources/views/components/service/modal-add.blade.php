<x-shared.modal id="modal-add" title="Tambah Layanan">
    <form>
        <div class="form-group">
            <label for="name">Nama Layanan</label>

            <input type="text" name="name" id="name" class="form-control" placeholder="Tulis nama layanan">

            <span class="text-danger msg-error name-error"></span>
        </div>

        <div class="form-group">
            <label for="unit">Satuan</label>

            <select class="select2" name="service_unit_id" id="unit" style="width: 100%;">
                <option></option>
            </select>

            <span class="text-danger msg-error service_unit_id-error"></span>
        </div>

        <div class="form-group">
            <label for="price">Harga</label>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text text-bold">Rp</span>
                </div>

                <input type="text" name="price" id="price" class="form-control" placeholder="Tulis harga">
            </div>

            <span class="text-danger msg-error price-error"></span>
        </div>

        <button type="submit" id="btn-save" class="btn btn-block btn-warning">Simpan</button>
    </form>
</x-shared.modal>

@push('scripts')
    <script>
        $(() => {
            // Mounted
            fetchUnit()

            $('#btn-add').click(() => {
                clearForm()
                $('.msg-error').text('')
                $('#modal-add').modal('show')
            })

            $('#btn-save').click((e) => {
                e.preventDefault()

                const name = $('#name').val()
                const unit = $('#unit').val()
                const price = $('#price').val()
                const unitId = $('#unit').find(':selected').val()

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('dashboard.services.store') }}",
                    data: {
                        name,
                        unit,
                        price,
                        service_unit_id: unitId,
                    },
                    success(res) {
                        const {
                            message,
                            status
                        } = res
                        alert(message, status)
                        $('#modal-add').modal('hide')
                        fetchServices()
                    },
                    error(res) {
                        const {
                            errors,
                            message,
                            status
                        } = res.responseJSON
                        if (status === 'failed') {
                            alert(message, status)
                        } else {
                            for (const key in errors) {
                                $(`.${key}-error`).text(errors[key])
                            }
                        }
                    }
                })
            })
            // end Mounted

            // Methods
            function fetchUnit() {
                $('#unit').select2({
                    placeholder: 'Pilih Hidangan',
                    theme: 'bootstrap4'
                })

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    type: 'get',
                    url: '/dashboard/service_units',
                    beforeSend() {
                        $('#unit').children('option:not(:first)').remove()
                    },
                    success(res) {
                        if (res) {
                            res.forEach((unit) => {
                                let newOption = new Option(unit.name, unit.id,
                                    false, false)
                                $('#unit').append(newOption)
                            })
                        }
                    }
                })
            }
            // end Methods
        })
    </script>
@endpush
