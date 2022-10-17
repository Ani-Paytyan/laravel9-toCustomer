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
                                <th scope="col">{{ __('attributes.employees.portal_access')}}</th>
                                <th scope="col">{{ __('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($paginator as $employee)
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
                                <td>
                                    @if($employee->getStatus() != $employee->getStatusDeleted())
                                        @if (Gate::allows('edit-employee'))
                                            @if ($employee->getId())
                                                <a href="{{ route('employees.edit', $employee->getId()) }}"
                                                   class="btn btn-sm btn-neutral">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            @endif
                                        @endif
                                        @if (Gate::allows('destroy-employee'))
                                                <form method="POST"
                                                      action="{{ route('employees.destroy', $employee->getId()) }}">
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
            {{ $paginator->links() }}
        </div>
    </main>
@endsection
