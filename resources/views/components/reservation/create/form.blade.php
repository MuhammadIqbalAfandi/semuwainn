<form>
    <div class="row">
        <div class="col-12 col-lg">
            <div class="form-group">
                <label for="guest-nik">NIK</label>
                <select data-width="100%" name="guest_id" id="guest-nik" class="select2">
                    <option></option>
                </select>

                <span class="guest_id-error msg-error text-danger"></span>
            </div>
        </div>

        <div class="col-12 col-lg">
            <div class="form-group">
                <label for="checkin">Checkin dan CheckOut </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control float-right" id="checkin-checkout" name="checkin_checkout">
                </div>

                <span class="checkin_checkout-error msg-error text-danger"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="room">Kamar</label>
                <select data-width="100%" name="room" id="room" class="select2">
                    <option></option>
                </select>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label>Harga Kamar</label>
                <select data-width="100%" name="price" id="price" class="select2">
                    <option></option>
                </select>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="guest">Tamu</label>
                <input class="form-control" name="guest" id="guest" type="text" placeholder="Jumlah Tamu" />

                <span class="guest-error msg-error text-danger"></span>
            </div>
        </div>

        <div class="col-auto mt-4">
            <button type="button" class="btn btn-sm btn-warning mt-2" id="btn-detail-room"><i
                    class="fa fa-plus"></i></button>
        </div>
    </div>
</form>

@push('scripts')
    <script>
        $(() => {
            // Mounted
            $('#checkin-checkout').daterangepicker()
            $('#checkin-checkout').change((e) => {})
            // end Mounted
        })
    </script>
@endpush
