@extends('layout.dashboard')
@section('title', __('page.unique-item.title') . " $uniqueItem->name ?? $uniqueItem->article")

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">{{ __('page.unique-item.title') }}</h4>
        </div>
        <div class="card-body">
            <p>{{ __('attributes.unique-items.item_name')}}: {{ $uniqueItem->item ? $uniqueItem->item->name : ''}}</p>
            <p>{{ __('attributes.unique-items.item_serial_number')}}: {{ $uniqueItem->item ? $uniqueItem->item->serial_number : ''}}</p>
            <p>{{ __('attributes.unique-items.unique_item_name')}}: {{ $uniqueItem->name }}</p>
            <p>{{ __('attributes.unique-items.unique_item_article')}}: {{ $uniqueItem->article }}</p>
            <p>{{ __('attributes.unique-items.status')}}: {{ $uniqueItem->is_online ? '+' : '-'  }}</p>
        </div>
    </div>

    <div class="mt-4">
        @include('unique-items.components.contacts-table')
    </div>

    @if (Gate::allows('create-unique-items'))
        <div class="mt-4">
            @include('unique-items.components.contacts-form')
        </div>
    @endif
@endsection
