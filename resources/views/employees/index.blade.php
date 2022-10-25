@extends('layout.dashboard')
@section('title')
    {{ __('page.employees.title')}}
@endsection
@section('content')
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            @include('layout.partials.messages')
            @if (Gate::allows('invite-employee'))
                <div>
                    <h4>{{ __('page.employees.title')}}</h4>
                    <div class="create-button">
                        <a href="{{ route('employees.create') }}" class="btn btn-sm btn-success">
                            <i class="bi bi-person"></i> {{ __('page.employees.invite_employee')}}
                        </a>
                    </div>
                </div>
            @endif
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
                                <td>{{ $employee->getFullNameAttribute() }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->role }}</td>
                                <td>{{ $employee->status }} </td>
                                <td>
                                    @if($employee->status != $statusDeleted)
                                        <a href="{{ route('teams.employee-teams', $employee->uuid) }}" class="btn btn-sm btn-neutral">
                                            <i class="bi bi-microsoft-teams"></i>
                                        </a>
                                        @if (Gate::allows('edit-employee'))
                                            <a href="{{ route('employees.edit', $employee->uuid) }}"
                                               class="btn btn-sm btn-neutral">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        @endif
                                        @if (Gate::allows('destroy-employee') && $userId !== $employee->uuid)
                                            <form method="POST"
                                                  class="btn btn-sm p-0"
                                                  action="{{ route('employees.destroy', $employee->uuid) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-sm btn-danger delete-employee">
                                                    <i class="bi bi-trash"></i>
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
