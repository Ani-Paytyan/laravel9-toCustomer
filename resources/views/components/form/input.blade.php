@php
/**
 * @var \Illuminate\View\ComponentAttributeBag $attributes
 * @var array $controlErrors
 */
@endphp

@include('components.form._label')

<input @class([
  'form-control',
  'is-invalid' => $controlErrors,
]) {{ $attributes }}>

@include('components.form._error')
