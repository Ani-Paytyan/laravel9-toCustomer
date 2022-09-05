@include('components.form._label')

<textarea @class([
  'form-control',
  'is-invalid' => $controlErrors,
]) {{ $attributes }}></textarea>

@include('components.form._error')
