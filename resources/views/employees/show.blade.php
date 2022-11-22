@extends('layout.dashboard')
@section('title')
    {{ __('page.employees.employee') }} : {{ $employee->getFullNameAttribute() }}
@endsection
@section('content')
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            <div class="p-2 pb-4">
                <h4><i class="bi bi-file-person"></i> {{ __('page.employees.employee') }} : {{ $employee->getFullNameAttribute() }}</h4>
                <p>{{ __('attributes.user.email')}} : {{ $employee->email }}</p>
                @if ($employee->city)
                    <p>{{ __('attributes.user.city')}} : {{ $employee->city }}</p>
                @endif
            </div>
            <div class="card mb-8">
                <div class="row card-header align-items-center">
                    @include('employees.components.workplace-table')
                    @include('employees.components.unique-item-table')
                    @include('employees.components.team-table')
                </div>
            </div>
        </div>
    </main>
@endsection
