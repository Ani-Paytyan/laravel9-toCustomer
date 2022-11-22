@extends('layout.dashboard')
@section('title', __('page.unique-items.title'))

@section('content')
    @include('layout.partials.messages')
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">{{ __('page.unique-items.title') }}</h4>
        </div>
        @if ($uniqueItems->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-records table-hover">
                    <thead>
                    <tr>
                        <th>{{ __('attributes.unique-items.item_name')}}</th>
                        <th>{{ __('attributes.unique-items.item_serial_number')}}</th>
                        <th>{{ __('attributes.unique-items.unique_item_name')}}</th>
                        <th>{{ __('attributes.unique-items.unique_item_article')}}</th>
                        <th>{{ __('attributes.unique-items.status')}}</th>
                        <th>{{ __('attributes.unique-items.connected_to')}}</th>
                        <th>{{ __('common.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($uniqueItems as $uniqueItem)
                        <tr>
                            <td>
                                <a href="{{ route('unique-items.show', $uniqueItem->uuid) }}">
                                    {{ $uniqueItem->item ? $uniqueItem->item->name : ' - '}}
                                </a>
                            </td>
                            <td>{{ $uniqueItem->item ? $uniqueItem->item->serial_number : ''}}</td>
                            <td>{{ $uniqueItem->name ?? ($uniqueItem->item ? $uniqueItem->item->name : '') }}</td>
                            <td>{{ $uniqueItem->article }}</td>
                            <td>{{ $uniqueItem->is_online ? '+' : '-' }}
                            <td>
                                <span>{{ __('attributes.unique-items.workplace')}}: {{ $uniqueItem->workplace->name}}</span><br>
                                @if(count($uniqueItem->contacts))
                                    <span>{{ __('attributes.unique-items.contacts')}}: </span>
                                    {{ $uniqueItem->contacts->pluck('first_name')->join(', ') }}
                                @endif
                            </td>
                            <td>
                                <a
                                    href="{{ route('unique-items.show', $uniqueItem->uuid) }}"
                                    class="btn btn-square"
                                    title="{{ __('page.unique-item.title') }}"
                                >
                                    <x-heroicon-o-eye />
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if ($uniqueItems->hasPages())
                <div class="card-footer pb-0">
                    {{ $uniqueItems->links() }}
                </div>
            @endif
        @else
            <div class="card-body">
                <i class="text-muted">{{ __('No unique items') }}</i>
            </div>
        @endif
    </div>
@endsection
