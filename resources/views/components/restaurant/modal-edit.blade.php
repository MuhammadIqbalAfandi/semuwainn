<x-shared.modal id="modal-edit" title="Ubah Hidangan">
    <form>
        <div class="form-group">
            <label for="name-edit">Nama Hidangan</label>

            <input type="text" name="name" id="name-edit" class="form-control"
                placeholder="Tulis nama hidangan disini">

            <span class="text-danger msg-error name-error"></span>
        </div>

        <div class="form-group">
            <label for="unit-edit">Satuan</label>

            <input type="text" name="unit" id="unit-edit" class="form-control" placeholder="Tulis nama satuan disini">

            <span class="text-danger msg-error unit-error"></span>
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

        <button id="btn-edit" type="submit" class="btn btn-block btn-warning">Simpan</button>
    </form>
</x-shared.modal>

@push('scripts')
    <script>
        $(() => {
            // Data
            const State = {
                id: '',
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
                    url: `restaurants/${id}/edit`,
                    beforeSend() {
                        $('.msg-error').text('')
                        $('#modal-edit').modal('show')
                    },
                    success(res) {
                        const {
                            name,
                            unit,
                            price
                        } = res
                        $('#name-edit').val(name)
                        $('#unit-edit').val(unit)
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
                    url: `restaurants/${id}`,
                    data: {
                        id,
                        name,
                        unit,
                        price,
                    },
                    beforeSend() {
                        $('.msg-error').text('')
                    },
                    success(res) {
                        const {
                            message,
                            status
                        } = res
                        alert(message, status)
                        $('#modal-edit').modal('hide')
                        fetchRestaurants()
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
        })
    </script>
@endpush
