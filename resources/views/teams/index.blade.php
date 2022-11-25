@extends('layout.dashboard')
@section('title')
    {{ __('page.teams.title')}}
@endsection
@section('content')
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            @include('layout.partials.messages')
            <div>
                <h4><i class="bi bi-people"></i> {{ __('page.teams.title')}}</h4>
                <div class="create-button">
                    <a href="{{ route('teams.create') }}" class="btn btn-sm btn-success">
                        <i class="bi bi-person"></i> {{ __('page.teams.create')}}
                    </a>
                </div>
            </div>
            <div class="card mb-8">
                <form action="{{ route('teams.index') }}" method="get">
                    <div class="row p-2 pb-4">
                        <div class="col-sm-4">
                            <x-form.input
                                name="name"
                                type="text"
                                id="filter_name"
                                placeholder="{{ __('attributes.user.name')}}"
                                class="form-control-muted"
                                value="{{ old('name') }}"
                            />
                        </div>
                        <div class="col-sm-5">
                            <x-form.input
                                name="description"
                                type="text"
                                id="filter_description"
                                placeholder="{{ __('attributes.team.description') }}"
                                class="form-control-muted"
                                value="{{ old('description') }}"
                            />
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-primary filter-form">
                                <i class="bi bi-funnel"></i>
                                {{ __('attributes.filter.title') }}
                            </button>
                            <button type="button" class="btn btn-warning filter-clean-form">
                                <i class="bi bi-x-circle"></i>
                                {{ __('attributes.filter.clean') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card mb-8">
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('attributes.user.name')}}</th>
                            <th scope="col">{{ __('attributes.team.description')}}</th>
                            <th scope="col">{{ __('common.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teams as $team)
                            <tr>
                                <td>{{ $team->name }}</td>
                                <td>{{ $team->description }}</td>
                                <td>
                                    <a href="{{ route('teams.edit', $team->uuid) }}"
                                       class="btn btn-sm btn-neutral"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="{{ __('page.teams.edit') }}"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST"
                                          class="btn btn-sm p-0"
                                          action="{{ route('teams.destroy', $team->uuid) }}"
                                          data-toggle="tooltip"
                                          data-placement="top"
                                          title="{{ __('page.teams.delete') }}"
                                    >
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-sm btn-danger delete-employee">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="navigation">
                {{ $teams->links() }}
            </div>
        </div>
    </main>
@endsection
