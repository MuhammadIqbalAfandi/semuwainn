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
         $(() => {
             //  Mounted
             $(document).on('click', '.btn-delete-detail', function() {
                 const id = $(this).attr('id')
                 State.listOfRestaurantBooked = State.listOfRestaurantBooked.filter((restaurant) =>
                     restaurant.id != id)
                 fetchRestaurant()

                 table.row($(this).parents('tr')).remove().draw()
             })

             $('#btn-save').click(() => {
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
                         id: {{ $reservationId }},
                         restaurants,
                     },
                     success(res) {
                         const {
                             message,
                             status
                         } = res
                         alert(message, status)
                         fetchRestaurant()
                         State.listOfRestaurantBooked = []
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
         })
     </script>
 @endpush
