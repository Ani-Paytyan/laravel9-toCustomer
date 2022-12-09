@extends('layout.dashboard')
@section('title', __('page.employees.title'))

@section('content')
    @include('layout.partials.messages')
    <div class="card">
        <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-md-between">
            <h4 class="text-center text-md-left mb-0">{{ __('page.employees.title')}}</h4>
            @if (Gate::allows('invite-employee'))
                <div class="mt-2 mt-md-0">
                    <a href="{{ route('employees.create') }}" class="btn btn-primary w-100">
                        <x-heroicon-o-paper-airplane />
                        {{ __('page.employees.invite_employee') }}
                    </a>
                </div>
            @endif
        </div>
        @if ($employees->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-records table-hover">
                    <thead>
                    <tr>
                        <th width="15%">{{ __('attributes.user.name')}}</th>
                        <th width="20%">{{ __('attributes.user.email')}}</th>
                        <th width="20%">{{ __('attributes.user.role')}}</th>
                        <th width="20%">{{ __('attributes.user.status')}}</th>
                        <th width="25%">{{ __('common.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $employee)
                        <tr x-data="employeeRow">
                            <td>
                                <a href="{{ route('employees.show', $employee->uuid) }}">
                                    {{ $employee->getFullNameAttribute() }}
                                </a>
                            </td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->role }}</td>
                            <td>{{ $employee->status }} </td>
                            <td class="text-nowrap">
                                @if($employee->status == 'Invited')
                                    <a
                                       href="{{ route('employee.remind-invite', $employee->uuid) }}"
                                       class="btn btn-sm btn-neutral"
                                       title="{{ __('page.employees.resend_invitation') }}"
                                    >
                                        <i class="bi bi-envelope"></i>
                                    </a>
                                @endif
                                @if ($employee->status != $statusDeleted)
                                    <a
                                            href="{{ route('employee.employee-workplaces', $employee->uuid) }}"
                                            class="btn btn-square"
                                            title="{{ __('page.workplaces.title') }}"
                                    >
                                        <x-heroicon-o-computer-desktop />
                                    </a>

                                    <a
                                            href="{{ route('employee.unique-items', $employee->uuid) }}"
                                            class="btn btn-square"
                                            title="{{ __('page.unique-items.title') }}"
                                    >
                                        <x-heroicon-o-shopping-bag />
                                    </a>

                                    <a
                                            href="{{ route('teams.employee-teams', $employee->uuid) }}"
                                            class="btn btn-square"
                                            title="{{ __('page.teams.title') }}"
                                    >
                                        <x-heroicon-o-user-group />
                                    </a>

                                    <a
                                            href="{{ route('employees.show', $employee->uuid) }}"
                                            class="btn btn-square"
                                            title="{{ __('page.employees.employee') }}"
                                    >
                                        <x-heroicon-o-eye />
                                    </a>

                                    @if (Gate::allows('edit-employee'))
                                        <a
                                                href="{{ route('employees.edit', $employee->uuid) }}"
                                                class="btn btn-square"
                                                title="{{ __('page.employees.edit_employee') }}"
                                        >
                                            <x-heroicon-o-pencil />
                                        </a>
                                    @endif
                                    @if (Gate::allows('destroy-employee') && $userId !== $employee->uuid)
                                        <form
                                                class="d-inline-block mb-0"
                                                method="POST"
                                                action="{{ route('employees.destroy', $employee->uuid) }}"
                                                x-ref="deleteForm"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                    @click.prevent="destroy('{{ __("Are you sure?") }}')"
                                                    class="btn btn-square text-danger"
                                                    title="{{ __('page.employees.delete_employee') }}"
                                                    :disabled="loading"
                                            >
                                                <x-heroicon-o-trash />
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if ($employees->hasPages())
                <div class="card-footer pb-0">
                    {{ $employees->links() }}
                </div>
            @endif
        @else
            <div class="card-body">
                <i class="text-muted">{{ __('No employees') }}</i>
            </div>
        @endif
    </div>
@endsection
