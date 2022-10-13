@extends('layout.dashboard')
@section('title')
    {{ __('page.employees.title')}}
@endsection
@section('content')
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            @include('layout.partials.messages')
            @if($superAdmin)
                <div>
                    <a href="{{ route('employees.create') }}" class="btn btn-sm btn-success"><i class="bi bi-person"></i> {{ __('employees.invite_employee')}}</a>
                </div>
            @endif
            <div class="card mb-8">
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap">
                        <thead class="table-light">
                        <tr>
                            <th scope="col">{{ __('attributes.user.name')}}</th>
                            <th scope="col">{{ __('attributes.user.email')}}</th>
                            <th scope="col">{{ __('attributes.user.role')}}</th>
                            <th scope="col">{{ __('attributes.user.status')}}</th>
                            <th scope="col">{{ __('attributes.employees.portal_access')}}</th>
                            <th class="text-end" scope="col">{{ __('common.actions')}}</th>
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
                                @if(Gate::allows('edit-employees'))
                                    <td>
                                        @if ($employee->getId())
                                            <a href="{{route('employees.edit', $employee->getId())}}" class="btn btn-sm btn-neutral"><i class="bi bi-pencil"></i>  {{ __('common.edit')}}</a>
                                            <a href="{{ route('employees.edit', $employee->getId()) }}" class="btn btn-sm btn-neutral"><i class="bi bi-pencil"></i></a>
                                        @endif
                                        @if ($employee->getStatus() != 'Deleted')
                                            <form method="POST" action="{{ route('employees.destroy', $employee->getId()) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-sm btn-danger delete-employee"><i class="bi bi-trash"></i></button>
                                            </form>
                                        @endif
                                    </td>
                                @endif
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
