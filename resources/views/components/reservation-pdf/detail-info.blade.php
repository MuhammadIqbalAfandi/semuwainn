<section class="mt-4">
    <section class="clearfix mb-2">
        <h2 class="float-left h4">Detail Pemesanan</h2>
    </section>

    <section class="clearfix mb-2">
        <section class="float-left">
            <section>
                <p class="text-secondary">Pemesan</p>
                <p>{{ $reservation->guest->name }}</p>
            </section>

            <section>
                <p class="text-secondary">Nomor HP</p>
                <p>{{ $reservation->guest->phone }}</p>
            </section>
        </section>

        <section class="float-right text-right">
            <section>
                <p class="text-secondary">Telah Dikonfirmasi Oleh</p>
                <p>{{ $reservation->user->name ?? '-' }}</p>
            </section>

            <section>
                <p class="text-secondary">Status Pemesanan</p>
                <p>{{ $reservation->reservationStatus->name }}</p>
            </section>
        </section>
    </section>

    <section class="clearfix  mb-2">
        <section class="float-left">
            <p class="text-secondary">Nomor Pemesanan</p>
            <p>{{ $reservation->reservation_number }}</p>
        </section>
    </section>

    <section class="clearfix  mb-2">
        <section class="float-left">
            <p class="text-secondary">Checkin</p>
            <p>{{ $reservation->check_in }}</p>
        </section>

        <section class="float-left ml-5">
            <p class="text-secondary">Checkout</p>
            <p>{{ $reservation->check_out }}</p>
        </section>

        <section class="float-left ml-5">
            <p class="text-secondary">Lama Inap</p>
            <p>{{ $nightCount }} Hari</p>
        </section>
    </section>

    <section class="clearfix  mb-2">
        <section class="float-left">
            <p class="text-secondary">Total Tamu</p>
            <p>{{ $reservation->roomOrders->pluck('guest_count')->count() }}</p>
        </section>

        <section class="float-left ml-5">
            <p class="text-secondary">Total Kamar</p>
            <p>{{ $reservation->roomOrders->pluck('guest_count')->count() }}</p>
        </section>

        <section class="float-left ml-5">
            <p class="text-secondary">Total Layanan</p>
            <p>{{ $reservation->serviceOrders->pluck('quantity')->count() }}</p>
        </section>

        <section class="float-left ml-5">
            <p class="text-secondary">Total Hidangan</p>
            <p>{{ $reservation->restaurantOrders->pluck('quantity')->count() }}</p>
        </section>
    </section>
</section>
