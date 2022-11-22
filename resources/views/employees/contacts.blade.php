@extends('layout.dashboard')
@section('title', __('page.workplace.title'))

@section('content')
    @include('layout.partials.messages')
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">{{ $employee->getFullNameAttribute() }} - {{ __('page.workplaces.title') }}</h4>
        </div>
        @if ($contactWorkPlaces->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-hover table-records">
                    <thead>
                    <tr>
                        <th>{{ __('attributes.user.name')}}</th>
                        <th>{{ __('attributes.user.address')}}</th>
                        <th>{{ __('attributes.user.zip')}}</th>
                        <th>{{ __('attributes.workplaces.number')}}</th>
                        <th>{{ __('attributes.user.city')}}</th>
                        <th>{{ __('common.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contactWorkPlaces as $contactWorkPlace)
                        <tr x-data="contactWorkplaceRow">
                            <td>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" x-show="loading"></span>
                                <a href="{{ route('workplaces.show', $contactWorkPlace->uuid) }}">
                                    {{ $contactWorkPlace->name }}
                                </a>
                            </td>
                            <td>{{ $contactWorkPlace->address }}</td>
                            <td>{{ $contactWorkPlace->zip }}</td>
                            <td>{{ $contactWorkPlace->number }}</td>
                            <td>{{ $contactWorkPlace->city }}</td>
                            <td>
                                <a
                                    href="{{ route('workplaces.show', $contactWorkPlace->uuid) }}"
                                    class="btn btn-square"
                                    title="{{ __('page.workplace.title') }}"
                                >
                                    <x-heroicon-o-eye />
                                </a>
                                @if (Gate::allows('destroy-workplace-contacts'))
                                    <button
                                        @click.prevent="destroy('{{ route('employee-workplaces.delete', [$employee->uuid, $contactWorkPlace->uuid]) }}', '{{ __("Are you sure?") }}')"
                                        class="btn btn-square text-danger"
                                        title="{{ __('page.workplace.delete_workplace') }}"
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
            @if ($contactWorkPlaces->hasPages())
                <div class="card-footer pb-0">
                    {{ $contactWorkPlaces->links() }}
                </div>
            @endif
        @else
            <div class="card-body">
                <i class="text-muted">{{ __('No contacts\' workplaces') }}</i>
            </div>
        @endif
    </div>

    @if (Gate::allows('create-workplace-contacts'))
        <div class="mt-4 card">
            <div class="card-header">
                <h4 class="mb-0">{{ __('page.workplace.add_workplace')}}</h4>
            </div>
            <form
                class="mb-0"
                x-data="contactWorkplaceForm('{{ route("employee-workplaces.store", $employee->uuid) }}')"
                x-bind="form"
            >
                <div class="card-body">
                    <x-form.select
                        name="workplace_id"
                        required
                        id="workplace_id"
                        label="{{ __('page.workplaces.title') }}"
                        :options="$workPlaceList"
                        x-ref="workplace"
                    />
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" :disabled="loading || disabledSubmit">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" x-show="loading"></span>
                        <x-heroicon-o-plus x-show="!loading" />
                        {{ __('page.workplace.add_workplace_btn') }}
                    </button>
                </div>
            </form>
        </div>
    @endif
@endsection
