 <table class="table table-bordered table-hover">
     <thead>
         <tr>
             <th>Nama Hidangan</th>
             <th>Jumlah Pesanan</th>
             <th>Harga</th>
             <th>Aksi</th>
         </tr>
     </thead>
 </table>

 <div class="row mt-3">
     <div class="col d-flex justify-content-end">
         <button type="button" class="btn btn-sm btn-warning" id="btn-save"><i class="fa fa-save"></i>
             Simpan pesanan</button>
     </div>
 </div>

 @push('scripts')
     <script>
         // Data
         const State = {
             initialRestaurants: [],
             listOfRestaurantBooked: [],
             error: false,
         }
         // end Data

         //  Mounted
         const table = $('.table').DataTable({
             paging: false,
             searching: false,
             ordering: false,
             info: false,
             autoWidth: false,
             scrollX: true,
             responsive: true,
         })

         $(document).on('click', '.btn-delete-detail', function() {
             const id = $(this).attr('id')
             State.listOfRestaurantBooked = State.listOfRestaurantBooked.filter((restaurant) =>
                 restaurant.id != id)
             fetchRestaurant()

             table.row($(this).parents('tr')).remove().draw()
         })

         $('#btn-save').click(() => {
             const id = $('#reservation-id').val()
             const restaurants = State.listOfRestaurantBooked

             if (!restaurants.length) {
                 return alert('Pesanan tidak boleh kosong', 'failed')
             }

             $.ajax({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 dataType: 'json',
                 type: 'post',
                 url: `/dashboard/restaurant-orders`,
                 data: {
                     id,
                     restaurants,
                 },
                 success(res) {
                     const {
                         message,
                         status
                     } = res
                     alert(message, status)
                     fetchRestaurant()
                     table.clear().draw()
                 },
                 error(res) {
                     const {
                         message,
                         status,
                     } = res.responseJSON
                     alert(message, status)
                 }
             })
         })
         // end Mounted

         // Methods
         function fetchRestaurant() {
             $('#restaurant').select2({
                 placeholder: 'Pilih Hidangan',
                 theme: 'bootstrap4',
             })

             $.ajax({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 dataType: 'json',
                 type: 'get',
                 url: '/dashboard/restaurant-orders',
                 beforeSend() {
                     $('#restaurant').children('option:not(:first)').remove()
                 },
                 success(res) {
                     if (res) {
                         State.initialRestaurants = res

                         const restaurants = _.differenceBy(res, State.listOfRestaurantBooked, 'id')
                         restaurants.forEach((restaurant) => {
                             let newOption = new Option(restaurant.name, restaurant.id,
                                 false, false)
                             $('#restaurant').append(newOption)
                         })
                     }
                 }
             })
         }

         function clearForm() {
             $('#restaurant').val(null).trigger('change');
             $('#quantity').val('')
         }
         // end Methods
     </script>
 @endpush
