<x-shared.modal id="modal-add" title="Tambah Hidangan Restoran">
    <form>
        <div class="form-group">
            <label for="name">Nama Hidangan</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Tulis nama hidangan disini">

            <span class="text-danger msg-error name-error"></span>
        </div>

        <div class="form-group">
            <label for="unit">Satuan</label>
            <input type="text" name="unit" id="unit" class="form-control" placeholder="Tulis nama satuan disini">

            <span class="text-danger msg-error unit-error"></span>
        </div>

        <div class="form-group">
            <label for="price">Harga</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text text-bold">Rp</span>
                </div>
                <input type="text" name="price" id="price" class="form-control" placeholder="Tulis harga disini">
            </div>

            <span class="text-danger msg-error price-error"></span>
        </div>

        <button id="btn-save" type="submit" class="btn btn-block btn-warning">Simpan</button>
    </form>
</x-shared.modal>

@push('scripts')
    <script>
        $(() => {
            // Mounted
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

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: 'restaurants',
                    data: {
                        name,
                        unit,
                        price
                    },
                    beforeSend() {
                        $('.msg-error').text('')
                    },
                    success(res) {
                        alert(res.message, res.status)
                        $('#modal-add').modal('hide')
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
                // end Mounted
            })
        })
    </script>
@endpush
