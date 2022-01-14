<x-shared.card title="{{ $title }}">
    <form>
        <input id="room-type-id" type="hidden" value="{{ $roomType->id ?? '' }}" />

        <div class="row">
            <div class="col-md-12 col-lg">
                <div class="form-group">
                    <label for="name">Nama Tipe Kamar</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Tuliskan tipe kamar"
                        value="{{ $roomType->name ?? '' }}">

                    <span class="text-danger msg-error name-error"></span>
                </div>
            </div>

            <div class="col-md-12 col-lg">
                <div class="form-group">
                    <label for="facilities">Fasilitas Kamar</label>
                    <select class="select2" multiple="multiple" name="facilities" id="facilities"
                        style="width: 100%;">
                        <option></option>
                    </select>

                    <span class="text-danger msg-error facilities-error"></span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="number-of-guest">Jumlah tamu</label>
                    <input type="text" id="number-of-guest" name="number_of_guest" class="form-control"
                        placeholder="Tuliskan jumlah tamu" value="{{ $roomType->number_of_guest ?? '' }}">

                    <span class="text-danger msg-error number_of_guest-error"></span>
                </div>
            </div>
        </div>

        <div class="dropdown-divider"></div>

        <div class="row">
            <div class="col mb-2">
                <h3 class="font-weight-bold">Harga</h3>
            </div>
            <div class="col-12" id="dynamic-form-wrapper">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="descriptions">Keterangan</label>
                            <input type="text" id="descriptions" name="descriptions" class="form-control"
                                placeholder="Tuliskan keterangan">

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
                                <input type="text" id="prices" name="prices" class="form-control"
                                    placeholder="Tuliskan harga">
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

        <button id="btn-save" type="submit" class="btn btn-block btn-warning">Simpan</button>
    </form>
</x-shared.card>

<x-room-type.room></x-room-type.room>

@push('scripts')
    <script>
        // Mounted
        $(document).on('click', '#btn-add-price', function() {
            createRoomElement()
        })
        // end Mounted
    </script>
@endpush
