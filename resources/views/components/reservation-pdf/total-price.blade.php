<section class="offset-auto text-right">
    <section>
        <span class="text-sm text-secondary">Sisa Tagihan</span>
        @if ($reservation->reservation_status_id === 3)
            <h3 class="text-danger text"><del>{{ $restOfBill }}</del></h3>
        @else
            <h3 class="text-danger">{{ $restOfBill }}</h3>
        @endif
    </section>

    <section>
        <span class="text-sm text-secondary">Telah Dibayar</span>
        <h3 class="text-success">{{ $payment }}</h3>
    </section>
</section>
