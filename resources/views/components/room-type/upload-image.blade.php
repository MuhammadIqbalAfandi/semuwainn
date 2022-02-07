@props(['roomType' => null])

<div class="row">
    <div class="col-12">
        <div class="form-group" id="input-file-container">
            <p>Upload Gambar</p>
            <span class="text-danger msg-error thumbnails-error"></span>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Data
        const btnSave = '<button type="submit" class="btn btn-block btn-warning mt-3">Simpan</button>'
        const thumbnails = []
        const files = []
        const fileLength = []
        // end Data

        // Mounted
        $('#input-file-container').append(`
            <input type="file" name="thumbnails[]" id="thumbnails" class="filepond" multiple>
        `)

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
            }, )
        })

        $.fn.filepond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginImageExifOrientation,
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType,
        )

        $('#thumbnails').filepond()

        $('#thumbnails').filepond('onremovefile', (error, file) => {
            if (!file.length || file.length >= 1) {
                $('[type="submit"]').remove()
                $('#form').append(btnSave)
            }
        })

        $('#thumbnails').filepond('onprocessfiles', () => {
            $('[type="submit"]').remove()
            $('#form').append(btnSave)
        })

        $('#thumbnails').filepond('onprocessfile', (error, file) => {
            console.log('object');
        })

        $('#thumbnails').filepond('onupdatefiles', (file) => {
            fileLength.push(file.length)

            if (fileLength.at(-1) > fileLength[0]) {
                $('[type="submit"]').remove()
                return
            }

            if (file.length && file[0].status === 9) {
                $('[type="submit"]').remove()
                return
            }
        })

        $.fn.filepond.setDefaults({
            labelIdle: 'Seret & Jatuhkan file Anda atau <span class="filepond--label-action"> Jelajahi </span>',
            labelButtonRetryItemLoad: 'Coba lagi',
            labelFileProcessingError: 'Ada kesalahan saat upload',
            labelFileProcessingRevertError: 'Ada kesalahan saat menghapus',
            labelFileProcessingComplete: 'Upload berhasil',
            labelInvalidField: 'Ada kesalahan pada gambar yang diupload',
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
