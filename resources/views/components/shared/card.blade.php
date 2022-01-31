@props(['cardTitle' => null, 'cardFills' => null, 'cardColor' => 'warning', 'outline' => 'outline'])

<div {{ $attributes->merge(['class' => 'card card-' . ($cardFills ? '' : $cardColor) . ' card-' . $outline]) }}>
    @if ($cardTitle)
        <div class="card-header">
            <h2 class="card-title">
                {{ $cardTitle }}
            </h2>
        </div>
    @endif

    @if ($cardFills)
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                {{ $cardFills }}
            </ul>
        </div>
    @endif

    <div class="card-body">
        {{ $slot }}
    </div>
</div>
