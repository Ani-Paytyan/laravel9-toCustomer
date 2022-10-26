@extends('layout.dashboard')
@section('title')
    {{ __('page.unique-item.title') }} {{ $uniqueItem->name ?? $uniqueItem->article }}
@endsection
@section('content')
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            <div class="p-2 pb-4">
                <h4>{{ __('page.unique-item.title')}} - {{ $uniqueItem->name ?? $uniqueItem->article }}</h4>
            </div>
            <div class="card mb-8">
                @include('unique-items.components.contacts-table')
                @include('unique-items.components.contacts-form')
            </div>
        </div>
    </main>
@endsection
