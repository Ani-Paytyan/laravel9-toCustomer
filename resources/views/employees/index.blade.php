@extends('layout.dashboard')
@section('title')
    {{ __('page.employees.title')}}
@endsection
@section('content')
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            @include('layout.partials.messages')
                <div>
                    <h4><i class="bi bi-people"></i> {{ __('page.employees.title')}}</h4>
                    @if (Gate::allows('invite-employee'))
                        <div class="create-button">
                            <a href="{{ route('employees.create') }}" class="btn btn-success">
                                <i class="bi bi-person"></i> {{ __('page.employees.invite_employee')}}
                            </a>
                            <a href="{{ route('employees.archive') }}" class="btn btn-sm btn-secondary">
                                <i class="bi bi-file-earmark-zip"></i> {{ __('page.employees.archive')}}
                            </a>
                        </div>
                    @endif
                </div>
            <div class="card mb-8">
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('attributes.user.name')}}</th>
                                <th scope="col">{{ __('attributes.user.email')}}</th>
                                <th scope="col">{{ __('attributes.user.role')}}</th>
                                <th scope="col">{{ __('attributes.user.status')}}</th>
                                <th scope="col">{{ __('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td>
                                    <a href="{{ route('employees.show', $employee->uuid) }}">
                                        {{ $employee->getFullNameAttribute() }}
                                    </a>
                                </td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->role }}</td>
                                <td>{{ $employee->status }} </td>
                                <td>
                                    @if($employee->status != $statusDeleted)
                                        <a href="{{ route('employee.employee-workplaces', $employee->uuid) }}"
                                           class="btn btn-sm btn-neutral"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{ __('page.workplaces.title') }}"
                                        >
                                            <i class="bi bi-person-workspace"></i>
                                        </a>
                                        <a href="{{ route('employee.unique-items', $employee->uuid) }}"
                                           class="btn btn-sm btn-neutral"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{ __('page.unique-items.title') }}"
                                        >
                                            <i class="bi bi-handbag"></i>
                                        </a>
                                        <a href="{{ route('teams.employee-teams', $employee->uuid) }}"
                                           class="btn btn-sm btn-neutral"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{ __('page.teams.title') }}"
                                        >
                                            <i class="bi bi-microsoft-teams"></i>
                                        </a>
                                        <a href="{{ route('employees.show', $employee->uuid) }}"
                                           class="btn btn-sm btn-neutral"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{ __('page.employees.employee') }}"
                                        >
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        @if (Gate::allows('edit-employee'))
                                            <a href="{{ route('employees.edit', $employee->uuid) }}"
                                               class="btn btn-sm btn-neutral"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               title="{{ __('page.employees.edit_employee') }}"
                                            >
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        @endif
                                        @if (Gate::allows('destroy-employee') && $userId !== $employee->uuid)
                                            <form method="POST"
                                                  class="btn btn-sm p-0"
                                                  action="{{ route('employees.destroy', $employee->uuid) }}"
                                                  data-toggle="tooltip"
                                                  data-placement="top"
                                                  title="{{ __('page.employees.archive_employee') }}"
                                            >
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-sm btn-neutral delete-employee">
                                                    <i class="bi bi-file-earmark-zip"></i>
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
            </div>
            {{ $employees->links() }}
        </div>
    </main>
@endsection
