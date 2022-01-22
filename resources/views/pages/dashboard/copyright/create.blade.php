<x-dashboard-layout title="Hak Cipta">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Hak Cipta">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-warning">Home</a></li>
                <li class="breadcrumb-item active">Hak Cipta</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <div class="row">
                <div class="col-12 col-lg">
                    <x-shared.card title="Tentang Semuwainn">
                        <strong><i class="fas fa-copyright mr-1"></i> Hak Cipta</strong>
                        <p class="text-muted">{{ $copyright }}</p>
                    </x-shared.card>
                </div>

                <div class="col-12 col-lg">
                    <x-shared.card title="Ubah Data">
                        <form method="post" action="{{ route('dashboard.copyrights.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="copyright">Copyright</label>
                                <input type="text" name="copyright" id="copyright" class="form-control"
                                    placeholder="Tulis copyright" value="{{ old('address') }}">
                                @error('copyright')
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

    @prepend('scripts')
        <script>
            // Mounted
            @if (session('success'))
                alert("{{ session('success') }}", 'success')
            @elseif (session('failed'))
                alert("{{ session('failed') }}", 'failed')
            @endif
            // end Mounted
        </script>
    @endprepend
</x-dashboard-layout>
