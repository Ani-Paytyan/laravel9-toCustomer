@include('components.form._label')

<textarea @class([
  'form-control',
  'is-invalid' => $controlErrors,
]) {{ $attributes }}>{{ $attributes->get('value') }}</textarea>

@include('components.form._error')
