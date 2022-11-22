@extends('layout.dashboard')
@section('title', __('page.unique-item.unique_items_contact'))

@section('content')
    @include('layout.partials.messages')
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">{{ __('page.unique-item.unique_items_contact') }} : {{ $employee->getFullNameAttribute() }}</h4>
        </div>
        @if ($uniqueItemContacts->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-hover table-records">
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
                    @foreach($uniqueItemContacts as $uniqueItem)
                        <tr x-data="employeeUniqueItemRow">
                            <td>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" x-show="loading"></span>
                                <a href="{{ route('unique-items.show', $uniqueItem->uuid) }}">
                                    {{ $uniqueItem->item ? $uniqueItem->item->name : ''}}
                                </a>
                            </td>
                            <td>{{ $uniqueItem->item ? $uniqueItem->item->serial_number : ''}}</td>
                            <td>{{ $uniqueItem->name }}</td>
                            <td>{{ $uniqueItem->article }}</td>
                            <td>
                                <a
                                    href="{{ route('unique-items.show', $uniqueItem->uuid) }}"
                                    class="btn btn-square"
                                    title="{{ __('page.unique-item.title') }}"
                                >
                                    <x-heroicon-o-eye />
                                </a>
                                @if (Gate::allows('destroy-unique-items'))
                                    <button
                                        @click.prevent="destroy('{{ route('employee-unique-items.delete', [$employee->uuid, $uniqueItem->uuid]) }}', '{{ __("Are you sure?") }}')"
                                        class="btn btn-square text-danger"
                                        title="{{ __('page.unique-item.delete') }}"
                                        :disabled="loading"
                                    >
                                        <x-heroicon-o-trash />
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if ($uniqueItemContacts->hasPages())
                <div class="card-footer pb-0">
                    {{ $uniqueItemContacts->links() }}
                </div>
            @endif
        @else
            <div class="card-body">
                <i class="text-muted">{{ __('No unique items') }}</i>
            </div>
        @endif
    </div>


    @if (Gate::allows('create-unique-items'))
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="mb-0">{{ __('page.unique-item.unique_item_add')}}</h4>
            </div>
            <form
                class="mb-0"
                x-data="employeeUniqueItemForm('{{ route('employee-unique-items.store', $employee->uuid) }}')"
                x-bind="form"
            >
                <div class="card-body">
                    <x-form.select
                        name="unique_item_id"
                        required
                        id="unique_item_id"
                        label="{{ __('page.unique-items.title') }}"
                        class="form-select role"
                        :options="$uniqueItemList"
                        x-ref="uniqueItem"
                    />
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" :disabled="loading || disabledSubmit">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" x-show="loading"></span>
                        <x-heroicon-o-plus x-show="!loading" />
                        {{ __('page.unique-item.unique_item_add_btn') }}
                    </button>
                </div>
            </form>
        </div>
    @endif
@endsection
