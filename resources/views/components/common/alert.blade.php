@php
    if ($fromSession) {
        $message = Session::get('message')['content'] ?? '';
        $type = Session::get('message')['type'] ?? $type;
    } else {
        $message = $slot;
    }
@endphp

<div @class([
        'alert',
        "alert-$type",
        'alert-dismissible' => $dismissible ?? false,
        'fade',
        'show',
    ])
    role="alert"
>
    {{ $message }}

    @if($dismissible)
        <button type="button" class="btn-close text-xs text-success" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>
