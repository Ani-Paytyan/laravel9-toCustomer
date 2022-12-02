@extends('layout.dashboard')
@section('title')
    {{ __('page.workplace.title') }} {{ $workPlace->name }}
@endsection
@section('content')
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            <div class="p-2 pb-4">
                <h4>{{ __('page.workplace.title') }}:</h4>
                <p>{{ __('attributes.workplace.name') }} : {{ $workPlace->name }}</p>
                @if ($workPlace->address)
                    <p>{{ __('attributes.workplace.address') }} : {{ $workPlace->address }}</p>
                @endif
                @if ($workPlace->city)
                    <p>{{ __('attributes.user.city') }} : {{ $workPlace->city }}</p>
                @endif
            </div>
        </div>
    </main>
@endsection
