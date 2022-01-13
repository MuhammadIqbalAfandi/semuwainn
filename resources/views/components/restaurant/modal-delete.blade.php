 <x-shared.modal id="modal-delete">
     <x-slot name="title">
         <i class="fa fa-exclamation-triangle text-danger"></i> Peringatan
     </x-slot>

     <p>Yakin akan menghapus data ini?</p>

     <x-slot name="footer">
         <button type="submit" id="btn-delete" class="btn btn-warning float-right btn-rounded w-140">Ya</button>
     </x-slot>
 </x-shared.modal>


 @push('scripts')
     <script>
         $(() => {
             // Data
             const State = {
                 id: ''
             }
             // end Data

             // Mounted
             $(document).on('click', '.btn-show-delete', function() {
                 State.id = $(this).attr('id')

                 $('#modal-delete').modal('show')
             })

             $('#btn-delete').click(() => {
                 const id = State.id

                 $.ajax({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     dataType: 'json',
                     type: 'delete',
                     url: `restaurants/${id}`,
                     success(res) {
                         alert(res.message, res.status)
                         $('#modal-delete').modal('hide')
                         fetchRestaurants()
                     },
                 })
             })
         })
         // end Mounted
     </script>
 @endpush