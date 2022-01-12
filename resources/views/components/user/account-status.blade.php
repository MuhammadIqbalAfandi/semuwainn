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
