@if ($userId !== auth()->user()->id && $userId !== 1)
    <i class="fas fa-ban btn-show-block text-danger" data-toggle="modal" id="{{ $userId }}"></i>
@endif
