@push('scripts')
    <script>
        function createRoomElement() {
            const priceElement = `
                        <div class="row">
                            <div class="col">
                                <!-- Description -->
                                <div class="form-group">
                                    <label for="descriptions">Keterangan</label>
                                    <input type="text" name="descriptions" class="form-control"
                                        placeholder="Tuliskan keterangan">

                                    <span class="text-danger msg-error descriptions-error"></span>
                                </div>
                            </div>

                            <div class="col">
                                <!-- Price -->
                                <div class="form-group">
                                    <label for="prices">Harga</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-bold">Rp</span>
                                        </div>
                                        <input type="text" name="prices" class="form-control" placeholder="Tuliskan harga">
                                    </div>
                                    <span class="text-danger msg-error prices-error"></span>
                                </div>
                            </div>

                            <div class="col-auto btn-remove-price mt-4">
                                <button type="button" class="btn btn-sm btn-warning mt-2"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    `
            $('#dynamic-form-wrapper').append(priceElement)
        }

        $(document).on('click', '.btn-remove-price', function() {
            $(this).parents(':eq(0)').remove()
        })
    </script>
@endpush
