@extends('layout.dashboard')
@section('title')
    {{ __('page.workplace.title') }} {{ $workplace->name }}
@endsection
@section('content')
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            <div class="p-2 pb-4">
                <h4>{{ __('page.workplace.title') }}</h4>
                <p>{{ __('attributes.workplace.name') }} : {{ $workplace->name }}</p>
                <p>{{ __('attributes.workplace.address') }} : {{ $workplace->address }}</p>
            </div>
            <div class="card mb-8">
                <div class="row card-header align-items-center">
                    @include('workplaces.components.contacts-table')
                    @if (Gate::allows('create-workplace-contacts'))
                        @include('workplaces.components.contacts-form')
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
