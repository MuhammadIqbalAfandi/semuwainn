<section>
    <h1>Detail Pemesanan</h1>

    <section>
        <section>
            <section>
                <p class="text-secondary">Pemesan</p>
                <p>{{ $reservation->guest->name }}</p>
            </section>

            <section>
                <p class="text-secondary">Nomor HP</p>
                <p>{{ $reservation->guest->phone }}</p>
            </section>
        </section>

        <section>
            <p class="text-secondary"> Terakhir Diubah Oleh</p>
            <p>{{ $reservation->user->name ?? '-' }}</p>
        </section>
    </section>

    <section>
        <section>
            <p class="text-secondary">Nomor Pemesanan</p>
            <p>{{ $reservation->reservation_number }}</p>
        </section>

        <section>
            <p class="text-secondary">Tanggal Pemesanan</p>
            <p>{{ $reservation->reservation_time }}</p>
        </section>
    </section>

    <section>
        <section>
            <p class="text-secondary">Checkin</p>
            <p>{{ $reservation->check_in }}</p>
        </section>

        <section>
            <p class="text-secondary">Checkout</p>
            <p>{{ $reservation->check_out }}</p>
        </section>

        <section>
            <p class="text-secondary">Lama Inap</p>
            <p>{{ $nightCount }} Hari</p>
        </section>
    </section>

    <section>
        <section>
            <p class="text-secondary">Total Tamu</p>
            <p>{{ $reservation->roomOrders->pluck('guest_count')->count() }}</p>
        </section>

        <section>
            <p class="text-secondary">Total Kamar</p>
            <p>{{ $reservation->roomOrders->pluck('guest_count')->count() }}</p>
        </section>

        <section>
            <p class="text-secondary">Total Layanan</p>
            <p>{{ $reservation->serviceOrders->pluck('quantity')->count() }}</p>
        </section>

        <section>
            <p class="text-secondary">Total Hidangan</p>
            <p>{{ $reservation->restaurantOrders->pluck('quantity')->count() }}</p>
        </section>
    </section>
</section>
