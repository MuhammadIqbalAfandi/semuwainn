<x-shared.modal title="Tambah Akun user" id="modal-add-guest">
    <form>
        <div class="form-group">
            <label for="nik-add">Nik</label>
            <input type="text" name="nik" id="nik-add" class="form-control" placeholder="Tulis nik">

            <span class="nik-add-error msg-error text-danger"></span>
        </div>

        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name-add" class="form-control" placeholder="Tulis nama">

            <span class="name-add-error msg-error text-danger"></span>
        </div>

        <div class="form-group">
            <label for="phone">Nomor HP</label>
            <input type="tel" pattern="[0-9]*" id="phone-add" name="phone" class="form-control"
                placeholder="Tulis nomor hp">

            <span class="phone-add-error msg-error text-danger"></span>
        </div>

        <div class="form-group">
            <label for="address">Alamat</label>
            <input type="address" name="address" id="address-add" class="form-control" placeholder="Tulis alamat">

            <span class="address-add-error msg-error text-danger"></span>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email-add" class="form-control" placeholder="Tulis email">

            <span class="email-add-error msg-error text-danger"></span>
        </div>

        <button type="submit" id="btn-add-guest" class="btn btn-block btn-warning">Simpan</button>
    </form>
</x-shared.modal>
