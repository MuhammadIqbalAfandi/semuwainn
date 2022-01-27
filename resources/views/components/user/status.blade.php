@if ($userId !== auth()->user()->id)
    <span @class([
        'badge',
        'badge-pill',
        'badge-success' => $status,
        'badge-danger' => !$status,
    ])>
        @if ($status)
            Aktif
        @else
            Tidak Aktif
        @endif
    </span>
@else
    <span class="badge badge-pill badge-success">
        Sedang Login
    </span>
@endif
