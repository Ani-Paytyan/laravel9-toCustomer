@extends('layout.dashboard')
@section('title', __('page.employees.employee') . " {$employee->getFullNameAttribute()}")

@section('content')
    @include('layout.partials.messages')
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">
                {{ __('page.employees.employee') }}: {{ $employee->getFullNameAttribute() }}
            </h4>
        </div>
        @if ($employee->city)
            <div class="card-body">
                {{ __('attributes.user.city') }}: {{ $employee->city }}
            </div>
        @endif
    </div>

    <div class="mt-4">
        @include('employees.components.workplace-table')
    </div>

    <div class="mt-4">
        @include('employees.components.unique-item-table')
    </div>

    <div class="mt-4">
        @include('employees.components.team-table')
    </div>
@endsection
