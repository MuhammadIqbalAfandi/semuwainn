 <div class="row">
     <div class="col text-right">
         <span class="text-sm text-secondary">Sisa Tagihan</span>
         @if ($reservation->reservation_status_id === 3)
             <h3 class="text-danger text"><del>{{ $restOfBill }}</del></h3>
         @else
             <h3 class="text-danger">{{ $restOfBill }}</h3>
         @endif
     </div>
 </div>
 <div class="row">
     <div class="col text-right">
         <span class="text-sm text-secondary">Telah Dibayar</span>
         <h3 class="text-success">{{ $payment }}</h3>
     </div>
 </div>
