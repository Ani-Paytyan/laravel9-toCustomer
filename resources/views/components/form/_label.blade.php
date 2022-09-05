@if ($label ?? false)
    <label
        class="form-label"
        @if ($id ?? $attributes->get('id')) for="{{ $id ?? $attributes->get('id') }}" @endif
    >
        {{ $label }}
        @if ($required ?? $attributes->get('required') && !($dontMarkLabelRequired ?? false))
            <small class="text-secondary">*</small>
        @endif
    </label>
@endif
