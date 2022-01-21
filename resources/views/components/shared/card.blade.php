<div {{ $attributes->merge(['class' => 'card card-warning']) }}>
    @if ($cardHeader ?? true)
        <div class="card-header">
            <h2 class="card-title">
                {{ $title ?? null }}
            </h2>
        </div>
    @endif

    <div class="card-body">
        {{ $slot }}
    </div>
</div>
