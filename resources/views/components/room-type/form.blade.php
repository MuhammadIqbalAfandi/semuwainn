<form enctype="multipart/form-data">
    <x-shared.card title="{{ $title }}">
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
    </x-shared.card>

    <x-room-type.upload-thumbnail></x-room-type.upload-thumbnail>

    <x-room-type.room></x-room-type.room>

    <button id="btn-save" type="submit" class="btn btn-block btn-warning">Simpan</button>
</form>

@push('scripts')
    <script>
        // Mounted
        $(document).on('click', '#btn-add-price', function() {
            createRoomElement()
        })
        // end Mounted
    </script>
@endpush
