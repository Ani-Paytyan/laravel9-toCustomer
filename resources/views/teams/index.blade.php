@extends('layout.dashboard')
@section('title')
    {{ __('page.teams.title')}}
@endsection
@section('content')
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            @include('layout.partials.messages')
            <div>
                <h4>{{ __('page.teams.title')}}</h4>
                <div class="create-button">
                    <a href="{{ route('teams.create') }}" class="btn btn-sm btn-success">
                        <i class="bi bi-person"></i> {{ __('page.teams.create')}}
                    </a>
                </div>
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
                                       class="btn btn-sm btn-neutral">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST"
                                          action="{{ route('teams.destroy', $team->uuid) }}">
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
