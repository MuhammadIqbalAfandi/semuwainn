<section class="offset-auto text-right">
    <section>
        <strong>Sisa Tagihan</strong><br />
        @if ($reservation->reservation_status_id === 3)
            <del>{{ $restOfBill }}</del>
        @else
            {{ $restOfBill }}
        @endif
    </section>

    <section>
        <strong>Telah Dibayar</strong><br />
        {{ $payment }}
    </section>
</section>
