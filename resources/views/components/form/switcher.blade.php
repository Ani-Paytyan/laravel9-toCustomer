<div @class(['custom-control custom-switch', $attributes->get('class')])>
    <input
        type="checkbox"
        id="{{ $id }}"
        name="{{ $name }}"
        @checked($attributes->get('checked'))
        {!! $attributes->merge(['class' => 'custom-control-input']) !!}
    >
    <label class="custom-control-label" for="{{ $id }}">{{ $label }}</label>
</div>
