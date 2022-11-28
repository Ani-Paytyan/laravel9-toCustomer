@extends('layout.dashboard')
@section('title')
    {{ __('page.employees.archive')}}
@endsection
@section('content')
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            @include('layout.partials.messages')
            <div class="p-2 pb-4">
                <h4><i class="bi bi-file-earmark-zip"></i> {{ __('page.employees.employees_archive') }}</h4>
            </div>
            <div class="card mb-8">
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('attributes.user.name')}}</th>
                            <th scope="col">{{ __('attributes.user.email')}}</th>
                            <th scope="col">{{ __('attributes.user.role')}}</th>
                            <th scope="col">{{ __('common.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td>
                                    <a href="{{ route('employee.archive', $employee->uuid) }}">
                                        {{ $employee->getFullNameAttribute() }}
                                    </a>
                                </td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->role }}</td>
                                <td>
                                    <a href="{{ route('employee.archive', $employee->uuid) }}"
                                       class="btn btn-sm btn-neutral"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="{{ __('page.employees.employee') }}"
                                    >
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="{{ route('employee.restore', $employee->uuid) }}"
                                       class="btn btn-sm btn-warning"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="{{ __('page.employees.restore_employee') }}"
                                    >
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="navigation">
                {{ $employees->links() }}
            </div>
        </div>
    </main>
@endsection
