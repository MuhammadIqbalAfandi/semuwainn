<div {{ $attributes->merge(['class' => 'modal fade']) }} data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog {{  $size ?? null }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{  $title ?? null  }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>

            @if ($footer ?? null)
            <div class="modal-footer">
                {{ $footer }}
            </div>
            @endif
        </div>
    </div>
</div>
