@extends('layout.dashboard')
@section('title')
    {{ __('page.unique-item.unique_items_contact')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('layout.partials.messages')
        <div class="card mb-7">
            <div class="row card-header align-items-center">
                <div class="page-title">
                    <h3>{{ __('page.unique-item.unique_items_contact')}} : {{ $employee->getFullNameAttribute() }} </h3>
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
                                    @if (Gate::allows('destroy-unique-items'))
                                        <th scope="col">{{ __('common.actions')}}</th>
                                    @endif
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
                                        @if (Gate::allows('destroy-unique-items'))
                                            <td>
                                                <a href="{{ route('unique-items.show', $uniqueItem->uuid) }}"
                                                   class="btn btn-sm btn-neutral"
                                                   data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="{{ __('page.unique-item.title') }}"
                                                >
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                                <a href="{{ route('employee-unique-items.delete', [$employee->uuid, $uniqueItem->uuid]) }}"
                                                   class="btn btn-sm btn-neutral unique-item-contacts-destroy"
                                                   data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="{{ __('page.unique-item.delete') }}"
                                                >
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="navigation navigation-employee">
                        {{ $uniqueItemContacts->links() }}
                    </div>
                @endif
                @if (Gate::allows('create-unique-items'))
                    <div class="mt-4 mb-4">
                        <h5>{{ __('page.unique-item.unique_item_add')}}</h5>
                    </div>
                    <form class="contacts-unique-item-form" method="POST" action="{{ route('employee-unique-items.store', $employee->uuid) }}">
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
                                <button class="btn btn-success addUniqueItemToContact">
                                    <i class="bi bi-person-plus"></i>
                                    {{ trans('page.unique-item.unique_item_add_btn') }}
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
