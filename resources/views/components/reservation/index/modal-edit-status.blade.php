 <x-shared.modal title="Ubah Status Pemesanan" id="modal-edit-status">
     <form>
         <div class="form-group">
             <label for="reservation-status">Status Pemesanan</label>
             <select class="select2" name="reservation_status" id="reservation-status" style="width: 100%;">
                 <option></option>
             </select>
         </div>

         <button type="submit" id="btn-edit-status" class="btn btn-block btn-warning">Simpan</button>
     </form>
 </x-shared.modal>

 @push('scripts')
     <script>
         $(() => {
             // Data
             const State = {
                 id: '',
                 reservationStatusId: '',
             }
             // end Data

             //  Mounted
             $(document).on('click', '.btn-show-edit-status', function() {
                 const id = $(this).attr('id')
                 State.id = id

                 $.ajax({
                     dataType: 'json',
                     type: 'get',
                     url: `reservation-statuses/${id}/edit`,
                     beforeSend() {
                         $('.msg-error').text('')
                         $('#modal-edit-status').modal('show')
                     },
                     success(res) {
                         if (res) {
                             State.reservationStatusId = res.reservation_status_id
                             fetchReservationStatus()
                         }
                     }
                 })
             })

             $('#btn-edit-status').click((e) => {
                 e.preventDefault()

                 const id = State.id
                 const reservationStatusId = $('#reservation-status').val();

                 $.ajax({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     dataType: 'json',
                     type: 'patch',
                     url: `reservations/${id}`,
                     data: {
                         id,
                         reservation_status_id: reservationStatusId
                     },
                     success(res) {
                         const {
                             message,
                             status
                         } = res
                         alert(message, status)
                         fetchReservation()
                         $('#modal-edit-status').modal('hide')
                     },
                     error(res) {
                         const {
                             message,
                             status
                         } = res.responseJSON
                         alert(message, status)
                         $('#modal-edit-status').modal('hide')
                     }
                 })
             })
             // end Mounted

             // Methods
             function fetchReservationStatus() {
                 $('#reservation-status').select2({
                     placeholder: 'Pilih Hidangan',
                     theme: 'bootstrap4'
                 })

                 $.ajax({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     dataType: 'json',
                     type: 'get',
                     url: `reservation-statuses`,
                     beforeSend() {
                         $('#reservation-status').children('option').remove()
                     },
                     success(res) {
                         if (res) {
                             res.forEach((reservationStatus) => {
                                 let newOption = new Option(
                                     reservationStatus.name,
                                     reservationStatus.id,
                                     false,
                                     State.reservationStatusId === reservationStatus.id ?? false,
                                 )
                                 $('#reservation-status').append(newOption)
                             })
                         }
                     }
                 })
             }
             // end Methods
         })
     </script>
 @endpush
