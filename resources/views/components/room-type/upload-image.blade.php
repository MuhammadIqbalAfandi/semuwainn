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
        // Data
        const btnSave = '<button type="submit" class="btn btn-block btn-warning mt-3">Simpan</button>'
        // end Data

        // Mounted
        $('#input-file-container').append(`
            <input type="file" name="thumbnails[]" id="thumbnails" class="filepond" multiple>
        `)

        $.fn.filepond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginImageExifOrientation,
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType,
        )

        $('#thumbnails').filepond()

        $('#thumbnails').filepond('onaddfilestart', (file) => {
            $('[type="submit"]').remove()
        })

        $('#thumbnails').filepond('onprocessfiles', (error, file) => {
            $('[type="submit"]').remove()
            $('#form').append(btnSave)
        })

        $('#thumbnails').filepond('onupdatefiles', (file) => {
            @if ($roomType)
                @if ($roomType->thumbnails->count())
                    $('[type="submit"]').remove()
                    $('#form').append(btnSave)
                @endif
            @endif
        })

        $.fn.filepond.setDefaults({
            maxFiles: 5,
            maxFileSize: '1MB',
            labelIdle: 'Seret & Jatuhkan file Anda atau <span class="filepond--label-action"> Jelajahi </span>',
            labelButtonRetryItemLoad: 'Coba lagi',
            labelFileProcessingError: 'Ada kesalahan saat upload',
            labelFileProcessingRevertError: 'Ada kesalahan saat menghapus',
            labelFileProcessingComplete: 'Upload berhasil',
            allowImageExifOrientation: true,
            imagePreviewMaxFileSize: '1MB',
            imagePreviewHeight: 256,
            styleButtonRemoveItemPosition: 'right',
            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/webp'],
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
