<div class="custom-control custom-checkbox">
    <input
        @class([
            'custom-control-input',
            'is-invalid' => $controlErrors
        ])
        type="checkbox"
        {{ $attributes }}
    >
    @include('components.form._label')
    @include('components.form._error')
</div>
