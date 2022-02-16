@if ($userId !== auth()->user()->id && $userId !== 1)
    <i class="fas fa-ban btn-show-block text-danger" data-toggle="modal" id="{{ $userId }}"></i>
    <a href="{{ route('dashboard.users.edit', $userId) }}">
        <i class="fas fa-edit mr-1 text-primary"></i>
    </a>
@endif
