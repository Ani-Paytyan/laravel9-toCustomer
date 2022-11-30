<div class="container-fluid">
    @include('layout.partials.messages')
    <div class="card mb-7">
        <div class="row card-header align-items-center">
            <div class="page-title">
                <h3>{{ __('page.unique-items.title')}} </h3>
            </div>
            @if($uniqueItemContacts->count() !== 0)
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap">
                            <thead class="table-light">
                            <tr>
                                <th scope="col">{{ __('attributes.unique-items.item_name')}}</th>
                                <th scope="col">{{ __('attributes.unique-items.item_serial_number')}}</th>
                                <th scope="col">{{ __('attributes.unique-items.unique_item_name')}}</th>
                                <th scope="col">{{ __('attributes.unique-items.unique_item_article')}}</th>
                                <th scope="col">{{ __('common.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($uniqueItemContacts as $uniqueItem)
                                <tr>
                                    <td>
                                        <a href="{{ route('unique-items.show', $uniqueItem->uuid) }}">
                                            {{ $uniqueItem->item ? $uniqueItem->item->name : ''}}
                                        </a>
                                    </td>
                                    <td>{{ $uniqueItem->item ? $uniqueItem->item->serial_number : ''}}</td>
                                    <td>{{ $uniqueItem->name }}</td>
                                    <td>{{ $uniqueItem->article }}</td>
                                    <td>
                                        <a href="{{ route('unique-items.show', $uniqueItem->uuid) }}"
                                           class="btn btn-sm btn-neutral"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{ __('page.unique-item.title') }}"
                                        >
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        @if (Gate::allows('destroy-unique-items'))
                                            <button data-href="{{ route('employee-unique-items.delete', [$employee->uuid, $uniqueItem->uuid]) }}"
                                               class="btn btn-sm btn-neutral unique-item-contacts-destroy"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               type="button"
                                               title="{{ __('page.unique-item.delete') }}"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            @if (Gate::allows('create-unique-items'))
                @if (!empty($uniqueItemList))
                    <div class="mt-4 mb-4">
                        <h5>{{ __('page.unique-item.unique_item_add')}}</h5>
                    </div>
                    <form class="contacts-unique-item-form" method="POST"
                          action="{{ route('employee-unique-items.store', $employee->uuid) }}">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-6">
                                <x-form.select
                                    name="unique_item_id"
                                    required
                                    id="unique_item_id"
                                    label="{{ __('page.unique-items.title') }}"
                                    class="form-select role"
                                    :options="$uniqueItemList"
                                />
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success addUniqueItemToContact">
                                    <i class="bi bi-person-plus"></i>
                                    {{ trans('page.unique-item.unique_item_add_btn') }}
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            @endif
        </div>
    </div>
</div>
