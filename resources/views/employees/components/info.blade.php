<h4><i class="bi bi-file-person"></i> {{ __('page.employees.employee') }} : {{ $employee->getFullNameAttribute() }}</h4>
@if ($employee->email)
    <p>{{ __('attributes.user.email')}} : {{ $employee->email }}</p>
@endif
@if ($employee->city)
    <p>{{ __('attributes.user.city')}} : {{ $employee->city }}</p>
@endif
@if ($employee->phone)
    <p>{{ __('attributes.user.phone')}} : {{ $employee->phone }}</p>
@endif
@if ($employee->city)
    <p>{{ __('attributes.user.city')}} : {{ $employee->city }}</p>
@endif
@if ($employee->address)
    <p>{{ __('attributes.user.address')}} : {{ $employee->address }}</p>
@endif
@if ($employee->zip)
    <p>{{ __('attributes.user.zip')}} : {{ $employee->zip }}</p>
@endif
