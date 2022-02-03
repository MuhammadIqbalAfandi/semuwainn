@props(['roomType' => null])

<div class="row">
    <div class="col-12">
        <p class="font-weight-bold">Upload Gambar</p>
    </div>

    <div class="col-12" id="input-file-container">
        <span class="text-danger msg-error images-error"></span>
    </div>
</div>

@push('scripts')
    <script>
        // Mounted
        const btnSave = '<button type="submit" class="btn btn-block btn-warning mb-3">Simpan</button>'

        $('#input-file-container').append(`
            <input type="file" name="thumbnails[]" id="thumbnails" class="filepond" multiple>
        `)

        $.fn.filepond.registerPlugin(
            FilePondPluginFilePoster,
            FilePondPluginImagePreview,
            FilePondPluginImageExifOrientation,
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType,
        )

        $('#thumbnails').filepond()

        $('#thumbnails').on('FilePond:addfilestart', () => {
            $('[type="submit"]').remove()
        })

        $('#thumbnails').on('FilePond:removefile', () => {
            $('[type="submit"]').remove()
            $('#form').append(btnSave)
        })

        $('#thumbnails').on('FilePond:processfiles', () => {
            $('[type="submit"]').remove()
            $('#form').append(btnSave)
        })

        $.fn.filepond.setDefaults({
            maxFiles: 5,
            maxFileSize: '1MB',
            allowReorder: true,
            imagePreviewMaxFileSize: '1MB',
            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/webp'],
            labelIdle: 'Seret & Jatuhkan file Anda atau <span class="filepond--label-action"> Jelajahi </span>',
            labelButtonRetryItemLoad: 'Coba lagi',
            labelFileProcessingError: 'Ada kesalahan saat upload',
            labelFileProcessingRevertError: 'Ada kesalahan saat menghapus',
            labelFileProcessingComplete: 'Upload berhasil',
            filePosterMinHeight: 44,
            filePosterMaxHeight: 256,
        })

        $.fn.filepond.setOptions({
            server: {
                url: '/dashboard/room-types/upload-thumbnails',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                process: '/process',
                revert: '/revert',
                load: '/load/?load=',
            },
            files: [
                @if ($roomType)
                    @foreach ($roomType->thumbnails as $thumbnail)
                        {
                        source: "{{ $thumbnail->file_name }}" ,
                        options: {
                        type: 'local',
                        metadata: {poster: "{{ asset('storage/thumbnails/' . $thumbnail->file_name) }}"},
                        }
                        },
                    @endforeach
                @endif
            ]
        })
        // end Mounted
    </script>
@endpush
