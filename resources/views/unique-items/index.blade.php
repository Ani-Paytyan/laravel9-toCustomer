@extends('layout.dashboard')
@section('title')
    {{ __('page.unique-items.title')}}
@endsection
@section('content')
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            @include('layout.partials.messages')
            <div class="p-2 pb-4">
                <h4>{{ __('page.unique-items.title')}}</h4>
            </div>
            <div class="card mb-8">
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('attributes.unique-items.item_name')}}</th>
                            <th scope="col">{{ __('attributes.unique-items.item_serial_number')}}</th>
                            <th scope="col">{{ __('attributes.unique-items.unique_item_name')}}</th>
                            <th scope="col">{{ __('attributes.unique-items.unique_item_article')}}</th>
                            <th scope="col">{{ __('common.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($uniqueItems as $uniqueItem)
                            <tr>
                                <td>{{ $uniqueItem->item ? $uniqueItem->item->name : ''}}</td>
                                <td>{{ $uniqueItem->item ? $uniqueItem->item->serial_number : ''}}</td>
                                <td>{{ $uniqueItem->name }}</td>
                                <td>{{ $uniqueItem->article }}</td>
                                <td>
                                    <a href="{{ route('unique-items.show', $uniqueItem->uuid) }}"
                                       class="btn btn-sm btn-neutral">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="navigation">
                {{ $uniqueItems->links() }}
            </div>
        </div>
    </main>
@endsection
