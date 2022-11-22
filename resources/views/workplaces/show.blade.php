@extends('layout.dashboard')
@section('title', __('page.workplace.title') . " $workplace->name")

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="text-center text-md-left mb-0">{{ __('page.workplace.title') }}</h4>
        </div>
        <div class="card-body">
            <p>{{ __('attributes.workplace.name') }} : {{ $workplace->name }}</p>
            <p>{{ __('attributes.workplace.address') }} : {{ $workplace->address }}</p>
            <p class="mb-0">{{ __('attributes.user.city') }} : {{ $workplace->city }}</p>
        </div>
    </div>

    <div class="mt-4">
        @include('workplaces.components.contacts-table')
    </div>

    @if (Gate::allows('create-workplace-contacts'))
        <div class="mt-4">
            @include('workplaces.components.contacts-form')
        </div>
    @endif

    <div class="mt-4">
        @include('workplaces.components.unique-items-table')
    </div>
@endsection
