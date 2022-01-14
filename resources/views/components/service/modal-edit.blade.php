<x-shared.modal id="modal-edit" title="Ubah Layanan">
    <form>
        <div class="form-group">
            <label for="name-edit">Nama Layanan</label>
            <input type="text" name="name" id="name-edit" class="form-control" placeholder="Tulis nama layanan disini">

            <span class="text-danger msg-error name-error"></span>
        </div>

        <div class="form-group">
            <label for="unit-edit">Satuan</label>
            <select class="select2" name="service_unit_id" id="unit-edit" style="width: 100%;">
                <option></option>
            </select>

            <span class="text-danger msg-error service_unit_id-error"></span>
        </div>

        <div class="form-group">
            <label for="price-edit">Harga</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text text-bold">Rp</span>
                </div>

                <input type="text" name="price" id="price-edit" class="form-control" placeholder="Tulis harga disini">

            </div>
            <span class="text-danger msg-error price-error"></span>
        </div>

        <button type="submit" id="btn-edit" class="btn btn-block btn-warning">Simpan</button>
    </form>
</x-shared.modal>

@push('scripts')
    <script>
        $(() => {
            // Data
            const State = {
                id: '',
                serviceUnitId: '',
            }
            // end Data

            // Mounted
            $(document).on('click', '.btn-show-edit', function() {
                const id = $(this).attr('id')
                State.id = id

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    type: 'get',
                    url: `services/${id}/edit`,
                    beforeSend() {
                        $('.msg-error').text('')
                        $('#modal-edit').modal('show')
                    },
                    success(res) {
                        const {
                            name,
                            serviceUnitId,
                            price
                        } = res
                        State.serviceUnitId = serviceUnitId
                        fetchUnit()

                        $('#name-edit').val(name)
                        $('#price-edit').val(price)
                    },
                })
            })

            $('#btn-edit').click((e) => {
                e.preventDefault()

                const id = State.id
                const name = $('#name-edit').val()
                const unit = $('#unit-edit').val()
                const price = $('#price-edit').val()

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    type: 'patch',
                    url: `services/${id}`,
                    data: {
                        id,
                        name,
                        service_unit_id: unit,
                        price,
                    },
                    success(res) {
                        alert(res.message, res.status)
                        $('#modal-edit').modal('hide')
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
                $('#unit-edit').select2({
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
                        $('#unit-edit').children('option:not(:first)').remove()
                    },
                    success(res) {
                        if (res) {
                            res.forEach((unit) => {
                                let newOption = new Option(unit.name, unit.id,
                                    false, State.serviceUnitId === unit.id ?? false)
                                $('#unit-edit').append(newOption)
                            })
                        }
                    }
                })
            }
            // end Methods
        })
    </script>
@endpush
