@props(['title', 'roomType' => null])

<x-shared.card title="{{ $title }}">
    <form id="form" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{ $roomType->id ?? '' }}">

        <div class="row">
            <div class="col-md-12 col-lg">
                <div class="form-group">
                    <label for="name">Nama Tipe Kamar</label>
                    <input type="text" name="name" class="form-control" placeholder="Tuliskan tipe kamar"
                        value="{{ $roomType->name ?? '' }}">

                    <span class="text-danger msg-error name-error"></span>
                </div>
            </div>

            <div class="col-md-12 col-lg">
                <div class="form-group">
                    <label for="facilities">Fasilitas Kamar</label>
                    <select class="select2" multiple="multiple" name="facilities[]" id="facilities"
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
                    <label for="number-of-guest">Jumlah Tamu</label>
                    <input type="text" name="number_of_guest" class="form-control" placeholder="Tuliskan jumlah tamu"
                        value="{{ $roomType->number_of_guest ?? '' }}">

                    <span class="text-danger msg-error number_of_guest-error"></span>
                </div>
            </div>
        </div>

        <x-dashboard.room-type.room-price></x-dashboard.room-type.room-price>

        <x-dashboard.room-type.upload-image :roomType="$roomType"></x-dashboard.room-type.upload-image>

        <button type="submit" class="btn btn-block btn-warning mt-3">Simpan</button>
    </form>
</x-shared.card>
