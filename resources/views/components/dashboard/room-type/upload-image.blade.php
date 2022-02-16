@props(['roomType' => null])

<div class="row">
    <div class="col-12">
        <div class="form-group" id="input-file-container">
            <p>Upload Gambar</p>
            <input type="file" name="thumbnails[]" id="thumbnails" class="filepond" multiple>
            @error('image')
                <span class="text-danger msg-error thumbnails-error">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Data
        const thumbnails = []
        const files = []
        const fileProcessed = []
        const fileAborts = []
        const fileReverts = []
        let fileLoad
        // end Data

        // Mounted
        @if ($roomType)
            @foreach ($roomType->thumbnails as $thumbnail)
                thumbnails.push({!! $thumbnail !!})
            @endforeach
        @endif

        thumbnails.forEach((thumbnail) => {
            files.push({
                source: thumbnail.file_name,
                options: {
                    type: 'local',
                    metadata: {
                        poster: `{{ asset('storage/thumbnails') }}/${thumbnail.file_name}`
                    },
                }
            })
        })

        $.fn.filepond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginImageExifOrientation,
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType,
        )

        $('#thumbnails').filepond()

        $('#thumbnails').filepond('onprocessfile', (error, file) => {
            if (!error) {
                fileProcessed.push(file)

                if ((fileLoad.length - fileProcessed.length) === thumbnails.length) {
                    $('[type="submit"]').show()

                    fileProcessed.length = 0
                }
            }
        })

        $('#thumbnails').filepond('onprocessfileabort', (file) => {
            fileAborts[0] = file

            if ((fileLoad.length - fileAborts.length) === thumbnails.length) {
                $('[type="submit"]').show()
            }
        })

        $('#thumbnails').filepond('onprocessfilerevert', (file) => {
            fileReverts[0] = file

            if ((fileLoad.length - fileReverts.length) === thumbnails.length) {
                $('[type="submit"]').show()
            }
        })

        $('#thumbnails').filepond('onaddfile', (error, file) => {
            if (!error) {
                if (fileLoad.length > thumbnails.length) {
                    $('[type="submit"]').hide()
                }

                if (file.status === 9) {
                    $('[type="submit"]').hide()
                }
            }
        })

        $('#thumbnails').filepond('onupdatefiles', (file) => {
            fileLoad = file
        })

        $.fn.filepond.setDefaults({
            labelIdle: 'Seret & Jatuhkan file Anda atau <span class="filepond--label-action"> Jelajahi </span>',
            labelButtonRetryItemLoad: 'Coba lagi',
            labelFileProcessingError: 'Ada kesalahan saat upload',
            labelFileProcessingRevertError: 'Ada kesalahan saat menghapus',
            labelFileProcessingComplete: 'Upload berhasil',
            labelFileTypeNotAllowed: 'Format file salah',
            labelMaxFileSizeExceeded: 'Ukuran file terlalu besar',
            labelMaxFileSize: 'Maksimal Ukuran gambar {filesize}',
            allowMultiple: true,
            allowImageExifOrientation: true,
            maxFiles: 5,
            maxFileSize: '1MB',
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
            files: files
        })
        // end Mounted
    </script>
@endpush
