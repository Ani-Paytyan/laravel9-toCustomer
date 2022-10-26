@extends('layout.dashboard')
@section('title')
    {{ __('page.unique-item.title') }} {{ $uniqueItem->name ?? $uniqueItem->article }}
@endsection
@section('content')
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            <div class="p-2 pb-4">
                <h4>{{ __('page.unique-item.title')}}</h4>
                <p>{{ __('attributes.unique-items.item_name')}} : {{ $uniqueItem->item->name }}</p>
                <p>{{ __('attributes.unique-items.item_serial_number')}} : {{ $uniqueItem->item->serial_number }}</p>
                <p>{{ __('attributes.unique-items.unique_item_name')}} : {{ $uniqueItem->name }}</p>
                <p>{{ __('attributes.unique-items.unique_item_article')}} : {{ $uniqueItem->article }}</p>
            </div>
            <div class="card mb-8">
                <div class="row card-header align-items-center">
                    @include('unique-items.components.contacts-table')
                    @include('unique-items.components.contacts-form')
                </div>
            </div>
        </div>
    </main>
@endsection
