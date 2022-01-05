<div {{ $attributes->merge(["class" => "card card-warning"])}}>
    <div class="card-header">
        <h2 class="card-title">
            {{ $title }}
        </h2>
    </div>

    <div class="card-body">
        {{ $slot }}
    </div>
</div>
