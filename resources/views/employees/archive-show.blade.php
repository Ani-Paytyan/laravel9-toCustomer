@extends('layout.dashboard')
@section('title')
    {{ __('page.employees.employee') }} : {{ $employee->getFullNameAttribute() }}
@endsection
@section('content')
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            <div class="p-2 pb-4">
                @include('employees.components.info')
            </div>
        </div>
    </main>
@endsection
