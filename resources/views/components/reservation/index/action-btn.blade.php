<div class="btn-group">
    <button class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown">
        Pilih
    </button>
    <ul class="dropdown-menu dropdown-menu-right">
        @if ($statusHide)
            <li id="{{ $id }}" class="dropdown-item btn-show-edit-status">Ubah Status</li>
            <li class="dropdown-item">
                <a href="{{ route('dashboard.service-orders.show', $id) }}" class="text-white">Tambah
                    Layanan</a>
            </li>
            <li class="  dropdown-item">
                <a href="{{ route('dashboard.restaurant-orders.show', $id) }}" class="text-white">Tambah
                    Hidangan</a>
            </li>
        @endif
        <li class=" dropdown-item">
            <a href="{{ route('dashboard.reservation-pdf.download', $id) }}" class="text-white">Download
                PDF</a>
        </li>
        <li class=" dropdown-item">
            <a href="{{ route('dashboard.reservation-pdf.send', $id) }}" class="text-white">Kirim PDF</a>
        </li>
    </ul>
</div>
