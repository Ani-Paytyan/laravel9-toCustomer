@extends('layout.dashboard')
@section('title')
    {{ __('page.workplace.title') }} {{ $workplace->name }}
@endsection
@section('content')
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            <div class="p-2 pb-4">
                <h4>{{ __('page.workplace.title') }}</h4>
                @if ($workplace->name)
                    <p>{{ __('attributes.workplace.name') }} : {{ $workplace->name }}</p>
                @endif
                @if ($workplace->address)
                    <p>{{ __('attributes.workplace.address') }} : {{ $workplace->address }}</p>
                @endif
                @if ($workplace->city)
                    <p>{{ __('attributes.user.city') }} : {{ $workplace->city }}</p>
                @endif
                @if ($workplace->description)
                    <p>{{ __('attributes.workplace_description.title') }} : {{ $workplace->description }}</p>
                @endif
            </div>
            <div class="card mb-8">
                <div class="row card-header align-items-center">
                    @include('workplaces.components.contacts-table')
                    @if (Gate::allows('create-workplace-contacts'))
                        @include('workplaces.components.contacts-form')
                    @endif
                    @include('workplaces.components.unique-items-table')
                </div>
            </div>
        </div>
    </main>
@endsection
