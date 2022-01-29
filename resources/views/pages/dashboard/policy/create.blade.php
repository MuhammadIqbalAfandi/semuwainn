<x-dashboard-layout title="Kebijakan">
    <x-shared.content-wrapper>
        <x-shared.content-header title="Kebijakan">
            <x-slot name="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-warning">Home</a></li>
                <li class="breadcrumb-item active">Kebijakan</li>
            </x-slot>
        </x-shared.content-header>

        <x-shared.content>
            <div class="row">
                <div class="col-12 col-md-6">
                    <x-shared.card>
                        <article>
                            {!! $policy !!}
                        </article>
                    </x-shared.card>
                </div>
                <div class="col-12 col-md-6">
                    <x-shared.card title="Ubah Data">
                        <form method="post" action="{{ route('dashboard.policies.store') }}">
                            @csrf
                            <input id="text" type="hidden" name="text">
                            <trix-editor input="text"></trix-editor>
                            @error('text')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <button type="submit" class="btn btn-small btn-warning btn-block mt-2">Simpan</button>
                        </form>
                    </x-shared.card>
                </div>
            </div>
        </x-shared.content>
    </x-shared.content-wrapper>
</x-dashboard-layout>
