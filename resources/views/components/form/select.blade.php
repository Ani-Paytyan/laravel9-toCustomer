@php
    /**
     * @var \Illuminate\View\ComponentAttributeBag $attributes
     */
@endphp

@include('components.form._label')

<select
    style="width: 100%"
    {{ $attributes }}
    data-placeholder="{{ $attributes->get('placeholder') ?? '' }}"
    @if (!$attributes->get('required')) data-allow-clear="true" @endif
    class="form-select select2"
    data-selection-css-class="@if ($controlErrors) is-invalid @endif"
    @if (!$withSearch) data-minimum-results-for-search="Infinity" @endif
>
    @if ($attributes->get('hide-default-option') !== true)
        <option></option>
    @endif

    @foreach($options as $optValue => $name)
        <option value="{{ $optValue }}" @if ($optValue == $attributes->get('value')) selected @endif>
            {{ $name }}
        </option>
    @endforeach
</select>

@include('components.form._error')
