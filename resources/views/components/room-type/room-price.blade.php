<div class="row">
    <div class="col-12" id="dynamic-form-wrapper">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="descriptions">Keterangan</label>
                    <input type="text" name="descriptions[]" class="form-control" placeholder="Tuliskan keterangan">

                    <span class="text-danger msg-error descriptions-error"></span>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="prices">Harga</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text text-bold">Rp</span>
                        </div>
                        <input type="text" name="prices[]" class="form-control" placeholder="Tuliskan harga">
                    </div>
                    <span class="text-danger msg-error prices-error"></span>
                </div>
            </div>

            <div class="col-auto mt-4">
                <button type="button" class="btn btn-sm btn-warning mt-2" id="btn-add-price"><i
                        class="fa fa-plus"></i></button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Mounted
        $(document).on('click', '#btn-add-price', function() {
            createRoomElement()
        })

        $(document).on('click', '.btn-remove-price', function() {
            $(this).parents(':eq(0)').remove()
        })
        // end Mounted

        // Methods
        function createRoomElement() {
            const priceElement = `
                        <div class="row">
                            <!-- Description -->
                            <div class="col">
                                <div class="form-group">
                                    <label for="descriptions">Keterangan</label>
                                    <input type="text" name="descriptions[]" class="form-control"
                                        placeholder="Tuliskan keterangan">

                                    <span class="text-danger msg-error descriptions-error"></span>
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="col">
                                <div class="form-group">
                                    <label for="prices">Harga</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-bold">Rp</span>
                                        </div>
                                        <input type="text" name="prices[]" class="form-control" placeholder="Tuliskan harga">
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
        // end Methods
    </script>
@endpush
