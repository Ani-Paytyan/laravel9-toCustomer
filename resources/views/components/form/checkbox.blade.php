<div class="form-check">
    <input
        @class([
            'form-check-input',
            'is-invalid' => $controlErrors
        ])
        type="checkbox"
        {{ $attributes }}
    >
    @include('components.form._label')
    @include('components.form._error')
</div>
