@extends('layout.dashboard')
@section('title')
    {{ __('employees.employees')}}
@endsection
@section('content')
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            <div class="card mb-8">
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap">
                        <thead class="table-light">
                        <tr>
                            <th scope="col">{{ __('employees.name')}}</th>
                            <th scope="col">{{ __('employees.email')}}</th>
                            <th scope="col">{{ __('employees.role')}}</th>
                            <th scope="col">{{ __('employees.status')}}</th>
                            <th scope="col">{{ __('employees.portal_access')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->getFullName() }}</td>
                                <td>{{ $employee->getEmail() }}</td>
                                <td>{{ $employee->getRole() }}</td>
                                <td>{{ $employee->getStatus() }} </td>
                                <td>
                                    @if($employee->getPortalAccess())
                                        <i class="bi bi-plus"></i>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
