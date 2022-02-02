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
         $('#input-file-container').append(`
                <input type="file" name="thumbnails[]" id="thumbnails" multiple>
             `)

         $.fn.filepond.registerPlugin(
             FilePondPluginImagePreview,
             FilePondPluginImageExifOrientation,
             FilePondPluginFileValidateSize,
             FilePondPluginFileValidateType,
         )
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
         })
         $.fn.filepond.setOptions({
             server: {
                 url: '/dashboard/room-types/upload-thumbnails',
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 process: '/process',
                 revert: '/revert',
             },
         })
         $('#thumbnails').filepond()
         $('#thumbnails').on('FilePond:addfilestart', () => {
             $('[type="submit"]').remove()
         })
         $('#thumbnails').on('FilePond:processfiles', () => {
             $('#form').append(`
                    <button type="submit" class="btn btn-block btn-warning mb-3">Simpan</button>
                 `)
         })
     </script>
 @endpush
