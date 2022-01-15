<x-dashboard-layout title="Tambah Layanan">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Tambah Layanan">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}"
                        class="text-warning">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.reservations.index') }}"
                        class="text-warning">Daftar
                        Pemesanan Kamar</a></li>
                <li class="breadcrumb-item active">Tambah Layanan</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <x-shared.card title="Tambah Layanan">
                <div class="row">
                    <div class="col-auto text-secondary">
                        Total Tamu
                        <p>0</p>
                    </div>
                    <div class="col-auto text-secondary">
                        Lama Inap
                        <p>0</p>
                    </div>
                </div>

                <form>
                    <input id="reservation-id" type="hidden" value="{{ $reservationId }}" />

                    <div class="row">
                        <div class="cols-md-12 col-lg">
                            <div class="form-group">
                                <label for="service">Tambah Layanan</label>
                                <select class="select2" name="service" id="service" style="width: 100%;">
                                    <option></option>
                                </select>

                                <span class="text-danger msg-error service-error"></span>
                            </div>
                        </div>

                        <div class="col col-lg">
                            <div class="form-group">
                                <label>Satuan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-bold"><i class="fas fa-tag"></i></span>
                                    </div>
                                    <input class="form-control" name="unit" id="unit" type="text" readonly />
                                </div>

                                <span class="text-danger msg-error unit-error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-lg-6">
                            <div class="form-group">
                                <label>Tamu</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-bold"><i class="fas fa-users"></i></span>
                                    </div>
                                    <input class="form-control" name="guest" id="guest" type="text" />
                                </div>

                                <span class="text-danger msg-error guest-error"></span>
                            </div>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nama Layanan</th>
                            <th>Kuantitas</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>

                <div class="row mt-3">
                    <div class="col d-flex justify-content-end">
                        <button type="button" class="btn btn-sm btn-warning" id="btn-save"><i
                                class="fa fa-save"></i>
                            Simpan pesanan</button>
                    </div>
                </div>
            </x-shared.card>
        </x-shared.content>
    </x-shared.content-wrapper>

    @push('scripts')
        <script>
            // Data
            // end Data

            // Mounted
            const table = $('.table').DataTable({
                paging: false,
                searching: false,
                ordering: false,
                info: false,
                autoWidth: false,
                scrollX: true,
                responsive: true,
            })
            // end Mounted

            // Methods

            // end Methods
        </script>
    @endpush
</x-dashboard-layout>
