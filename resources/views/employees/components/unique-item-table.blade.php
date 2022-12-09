<div class="card">
    <div class="card-header">
        <h4 class="mb-0">{{ __('page.unique-items.title') }}</h4>
    </div>
    @if ($uniqueItems->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-records table-hover">
                <thead>
                <tr>
                    <th>{{ __('attributes.unique-items.item_name') }}</th>
                    <th>{{ __('attributes.unique-items.item_serial_number') }}</th>
                    <th>{{ __('attributes.unique-items.status') }}</th>
                    <th>{{ __('common.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($uniqueItems as $uniqueItem)
                    <tr>
                        <td>
                            <a href="{{ route('unique-items.show', $uniqueItem->uuid) }}">
                                {{ $uniqueItem->name ?? ($uniqueItem->item ? $uniqueItem->item->name : '') }}
                            </a>
                        </td>
                        <td>{{ $uniqueItem->article }}</td>
                        <td>{{ $uniqueItem->is_online ? '+' : '-' }}</td>
                        <td>
                            <a
                                    href="{{ route('unique-items.show', $uniqueItem->uuid) }}"
                                    class="btn btn-square"
                                    title="{{ __('page.unique_item.title') }}"
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
