@extends('layout.dashboard')
@section('title', __('page.teams.title'))

@section('content')
    @include('layout.partials.messages')
    <div class="card">
        <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-md-between">
            <h4 class="text-center text-md-left mb-md-0">{{ __('page.teams.title')}}</h4>
            <div>
                <a href="{{ route('teams.create') }}" class="btn btn-primary w-100">
                    <x-heroicon-o-plus />
                    {{ __('page.teams.create')}}
                </a>
            </div>
        </div>
        @if ($teams->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-records table-hover">
                    <thead>
                    <tr>
                        <th scope="col">{{ __('attributes.user.name')}}</th>
                        <th scope="col">{{ __('attributes.team.description')}}</th>
                        <th scope="col">{{ __('common.actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($teams as $team)
                        <tr x-data="teamRow">
                            <td>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" x-show="loading"></span>
                                {{ $team->name }}
                            </td>
                            <td>{{ $team->description }}</td>
                            <td class="text-nowrap">
                                <a
                                        href="{{ route('teams.edit', $team->uuid) }}"
                                        class="btn btn-square"
                                        title="{{ __('page.teams.edit') }}"
                                >
                                    <x-heroicon-o-pencil />
                                </a>
                                <form
                                        class="d-inline-block mb-0"
                                        method="POST"
                                        action="{{ route('teams.destroy', $team->uuid) }}"
                                        x-ref="deleteForm"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                            @click.prevent="destroy('{{ __("Are you sure?") }}')"
                                            class="btn btn-square text-danger"
                                            title="{{ __('page.teams.delete') }}"
                                            :disabled="loading"
                                    >
                                        <x-heroicon-o-trash />
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if ($teams->hasPages())
                <div class="card-footer pb-0">
                    {{ $teams->links() }}
                </div>
            @endif
        @else
            <div class="card-body">
                <i class="text-muted">{{ __('No teams') }}</i>
            </div>
        @endif
    </div>
@endsection
