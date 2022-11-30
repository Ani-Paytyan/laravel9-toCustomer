@if ($uniqueItems->count() !== 0)
    <div class="mt-4 mb-4">
        <h4>{{ __('page.unique-items.title')}} :</h4>
    </div>
    <div class="card mb-8">
        <div class="table-responsive">
            <table class="table table-hover table-nowrap">
                <thead class="table-light">
                <tr>
                    <th scope="col">{{ __('attributes.unique-items.item_name') }}</th>
                    <th scope="col">{{ __('attributes.unique-items.item_serial_number') }}</th>
                    <th scope="col">{{ __('attributes.unique-items.status') }}</th>
                    <th scope="col">{{ __('common.actions') }}</th>
                </tr>
                </thead>
                <tbody class="contact-list">
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
                            <a href="{{ route('unique-items.show', $uniqueItem->uuid) }}"
                               class="btn btn-sm btn-neutral"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="{{ __('page.unique-item.title') }}"
                            >
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
@endif
