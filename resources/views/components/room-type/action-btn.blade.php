<a href="{{ route('dashboard.room-types.edit', $id) }}">
    <i class="fas fa-edit mr-1 btn-show-edit text-primary"></i>
</a>
@if ($btnDeleteHide)
    <i class="fas fa-trash-alt btn-show-delete text-danger" id="{{ $id }}"></i>
@endif
