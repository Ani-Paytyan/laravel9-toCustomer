@extends('layout.dashboard')
@section('title', __('page.workplaces.title'))

@section('content')
    @include('layout.partials.messages')
    <div class="card">
        <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-md-between">
            <h4 class="mb-md-0">{{ __('page.workplaces.title')}}</h4>
            @if (Gate::allows('create-workplace'))
                <div>
                    <a href="{{ route('workplaces.create') }}" class="btn btn-primary w-100">
                        <x-heroicon-o-plus />
                        {{ __('page.workplaces.create') }}
                    </a>
                </div>
            @endif
        </div>
        @if ($workPlaces->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-records table-hover">
                    <thead>
                    <tr>
                        <th>{{ __('attributes.user.name')}}</th>
                        <th>{{ __('attributes.user.address')}}</th>
                        <th>{{ __('attributes.user.city')}}</th>
                        <th>{{ __('attributes.workplaces.total-online')}}</th>
                        <th>{{ __('common.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($workPlaces as $workPlace)
                        <tr x-data="workplaceRow">
                            <td>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" x-show="loading"></span>
                                <a href="{{ route('workplaces.show', $workPlace->uuid) }}">
                                    {{ $workPlace->name }}
                                </a>
                            </td>
                            <td>{{ $workPlace->address }}</td>
                            <td>{{ $workPlace->city }}</td>
                            <td>
                                {{ $workPlace->uniqueItems ? $workPlace->uniqueItems->count() : 0 }}
                                /
                                {{ $workPlace->uniqueItems ? $workPlace->uniqueItems->where('is_online', 1)->count() : 0 }}
                            </td>
                            <td class="text-nowrap">
                                @if (Gate::allows('create-workplace-working-days'))
                                    <a
                                            href="{{ route('workplace.workdays', $workPlace->uuid) }}"
                                            class="btn btn-square"
                                            title="{{ __('page.workplaces.work_days') }}"
                                    >
                                        <x-heroicon-o-calendar-days />
                                    </a>
                                @endif
                                <a
                                        href="{{ route('workplaces.show', $workPlace->uuid) }}"
                                        class="btn btn-square"
                                        title="{{ __('page.workplace.title') }}"
                                >
                                    <x-heroicon-o-eye />
                                </a>
                                @if (Gate::allows('edit-workplace'))
                                    <a
                                            href="{{ route('workplaces.edit', $workPlace->uuid) }}"
                                            class="btn btn-square"
                                            title="{{ __('page.workplace.edit') }}"
                                    >
                                        <x-heroicon-o-pencil />
                                    </a>
                                @endif
                                @if (Gate::allows('destroy-workplace'))
                                    <form
                                            class="d-inline-block mb-0"
                                            method="POST"
                                            action="{{ route('workplaces.destroy', $workPlace->uuid) }}"
                                            x-ref="deleteForm"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                                @click.prevent="destroy('{{ __("Are you sure?") }}')"
                                                class="btn btn-square text-danger"
                                                title="{{ __('page.workplace.delete_workplace') }}"
                                                :disabled="loading"
                                        >
                                            <x-heroicon-o-trash />
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if ($workPlaces->hasPages())
                <div class="card-footer pb-0">
                    {{ $workPlaces->links() }}
                </div>
            @endif
        @else
            <div class="card-body">
                <i class="text-muted">{{ __('No work places') }}</i>
            </div>
        @endif
    </div>
@endsection
