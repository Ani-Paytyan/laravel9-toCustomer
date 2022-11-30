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
            @include('teams.components.filter')
            <div class="card mb-8">
                <div class="table-responsive">
                    @if($teams->count() > 0)
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
                    @else
                        <div class="alert alert-info" role="alert">
                            {{ __('page.teams.not_found') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="navigation">
                {{ $teams->links() }}
            </div>
        </div>
    </main>
@endsection
