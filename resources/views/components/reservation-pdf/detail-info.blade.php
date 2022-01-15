<section>
    <h1>Detail Pemesanan</h1>

    <section>
        <section>
            <section>
                <p>Pemesan</p>
                <p>{{ $reservation->guest->name }}</p>
            </section>

            <section>
                <p>Nomor HP</p>
                <p>{{ $reservation->guest->phone }}</p>
            </section>
        </section>

        <section>
            <p> Terakhir Diubah Oleh</p>
            <p>{{ $reservation->user->name ?? '-' }}</p>
        </section>
    </section>

    <section>
        <section>
            <p>Nomor Pemesanan</p>
            <p>{{ $reservation->reservation_number }}</p>
        </section>

        <section>
            <p>Tanggal Pemesanan</p>
            <p>{{ $reservation->reservation_time }}</p>
        </section>
    </section>

    <section>
        <section>
            <p>Checkin</p>
            <p>{{ $reservation->check_in }}</p>
        </section>

        <section>
            <p>Checkout</p>
            <p>{{ $reservation->check_out }}</p>
        </section>

        <section>
            <p>Lama Inap</p>
            <p>{{ $nightCount }} Hari</p>
        </section>
    </section>

    <section>
        <section>
            <p>Total Tamu</p>
            <p>{{ $reservation->roomOrders->pluck('guest_count')->count() }}</p>
        </section>

        <section>
            <p>Total Kamar</p>
            <p>{{ $reservation->roomOrders->pluck('guest_count')->count() }}</p>
        </section>

        <section>
            <p>Total Layanan</p>
            <p>{{ $reservation->serviceOrders->pluck('quantity')->count() }}</p>
        </section>

        <section>
            <p>Total Hidangan</p>
            <p>{{ $reservation->restaurantOrders->pluck('quantity')->count() }}</p>
        </section>
    </section>
</section>
