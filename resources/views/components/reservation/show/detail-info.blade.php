<div class="row">
    <div class="col">
        <div class="row">
            <div class="col-auto">
                <p class="text-secondary">Pemesan</p>
                <p>{{ $reservation->guest->name }}</p>
            </div>
            <div class="col-auto">
                <p class="text-secondary">Nomor HP</p>
                <p>{{ $reservation->guest->phone }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="text-secondary">Nomor Pemesanan</p>
                <p>{{ $reservation->reservation_number }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="text-secondary">Tanggal Pemesanan</p>
                <p>{{ $reservation->reservation_time }}</p>
            </div>
        </div>
    </div>
    <div class="col-auto">
        <div class="row">
            <div class="col text-right">
                <p class="text-secondary"> Terakhir Diubah Oleh</p>
                <p>{{ $reservation->user->name ?? '' }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col text-right">
                <p class="text-secondary">Status Pemesanan</p>
                <p>{{ $reservation->reservationStatus->name }}</p>
            </div>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-auto mr-3">
        <p class="text-secondary">Checkin</p>
        <p>{{ $reservation->check_in }}</p>
    </div>
    <div class="col-auto mr-3">
        <p class="text-secondary">Checkout</p>
        <p>{{ $reservation->check_out }}</p>
    </div>
    <div class="col-auto">
        <p class="text-secondary">Lama Inap</p>
        <p>{{ $nightCount }} Hari</p>
    </div>
</div>
<div class="row mb-4">
    <div class="col-auto mr-3">
        <p class="text-secondary">Total Tamu</p>
        <p>{{ $reservation->roomOrders->pluck('guest_count')->count() }}</p>
    </div>
    <div class="col-auto mr-3">
        <p class="text-secondary">Total Kamar</p>
        <p>{{ $reservation->roomOrders->pluck('guest_count')->count() }}</p>
    </div>
    <div class="col-auto mr-3">
        <p class="text-secondary">Total Layanan</p>
        <p>{{ $reservation->serviceOrders->pluck('quantity')->count() }}</p>
    </div>
    <div class="col-auto">
        <p class="text-secondary">Total Hidangan</p>
        <p>{{ $reservation->restaurantOrders->pluck('quantity')->count() }}</p>
    </div>
</div>
