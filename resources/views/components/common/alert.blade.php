<div @class([
        'alert',
        "alert-$type",
        'alert-dismissible' => $dismissible ?? false,
        'fade',
        'show',
    ])
    role="alert"
>
    {{ $slot }}

    @if($dismissible)
        <button type="button" class="btn-close text-xs text-success" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>
