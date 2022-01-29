<x-dashboard-layout title="Kontak">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Kontak">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-warning">Home</a></li>
                <li class="breadcrumb-item active">Kontak</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <div class="row">
                <div class="col-12 col-md-6">
                    <x-shared.card>
                        <strong><i class="fas fa-mobile-alt mr-1"></i> Whatsapp</strong>
                        <p class="text-muted">{{ $whatsapp }}</p>

                        <hr>

                        <strong><i class="fas fa-phone-alt mr-1"></i> Call Center</strong>
                        <p class="text-muted">{{ $callCenter }}</p>

                        <hr>

                        <strong><i class="fas fa-at mr-1"></i> Email</strong>
                        <p class="text-muted">{{ $email }}</p>

                        <hr>

                        <strong><i class="fas fa-location-arrow mr-1"></i> Alamat</strong>
                        <p class="text-muted">{{ $address }}</p>
                    </x-shared.card>
                </div>

                <div class="col-12 col-md-6">
                    <x-shared.card title="Ubah Data">
                        <form method="post" action="{{ route('dashboard.contacts.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="whatsapp">Whatsapp</label>
                                <input type="text" name="whatsapp" id="whatsapp" class="form-control"
                                    placeholder="Tulis nomor whatsapp" value="{{ old('whatsapp') }}">
                                @error('whatsapp')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="call-center">Call Center</label>
                                <input type="text" name="call_center" id="call-center" class="form-control"
                                    placeholder="Tulis nomor call center" value="{{ old('call_center') }}">
                                @error('call_center')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="Tulis email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    placeholder="Tulis alamat" value="{{ old('address') }}">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-small btn-warning btn-block">Simpan</button>
                        </form>
                    </x-shared.card>
                </div>
            </div>
        </x-shared.content>
    </x-shared.content-wrapper>
</x-dashboard-layout>
