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
                <div class="create-button">
                    @if (Gate::allows('invite-employee'))
                        <a href="{{ route('employees.create') }}" class="btn btn-success">
                            <i class="bi bi-person"></i> {{ __('page.employees.invite_employee')}}
                        </a>
                    @endif
                    <a href="{{ route('employees.archive') }}" class="btn btn-sm btn-secondary">
                        <i class="bi bi-file-earmark-zip"></i> {{ __('page.employees.archive')}}
                    </a>
                </div>
            </div>
            @include('employees.components.filter')
            <div class="card mb-8">
                <div class="table-responsive">
                    @if($employees->count() > 0)
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
                                    @if($employee->status == 'Invited')
                                        <a href="{{ route('employee.remind-invite', $employee->uuid) }}"
                                           class="btn btn-sm btn-neutral"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{ __('page.employees.resend_invitation') }}"
                                        >
                                            <i class="bi bi-envelope"></i>
                                        </a>
                                    @endif
                                    @if($employee->status != $statusDeleted)
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
                                            @if($employee->workplaces->count() === 0 && $employee->uniqueItems->count() === 0)
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
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="alert alert-info" role="alert">
                            {{ __('page.employees.not_found') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="navigation">
                {{ $employees->links() }}
            </div>
        </div>
    </main>
@endsection
