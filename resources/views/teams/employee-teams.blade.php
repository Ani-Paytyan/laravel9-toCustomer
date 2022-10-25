@extends('layout.dashboard')
@section('title')
    {{ __('page.user.user_teams')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('layout.partials.messages')
        <div class="card mb-7">
            <div class="row card-header align-items-center">
                <div class="page-title">
                    <h3>{{ __('page.user.user_teams')}}</h3>
                </div>
                @if($userTeams)
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-hover table-nowrap">
                                <thead class="table-light">
                                <tr>
                                    <th scope="col">{{ __('attributes.team.name')}}</th>
                                    <th scope="col">{{ __('attributes.team.user_role')}}</th>
                                    <th scope="col">{{ __('common.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody class="users-list">
                                @foreach($userTeams as $teamUser)
                                    <tr>
                                        <td>{{ $teamUser->team->name }}</td>
                                        <td>
                                            <x-form.select
                                                name="role"
                                                required
                                                placeholder="{{ __('attributes.user.role') }}"
                                                class="form-select role"
                                                :hide-default-option="true"
                                                :options="$roles"
                                                value="{{ $teamUser->role }}"
                                            />
                                        </td>
                                        <td>
                                            <a href="{{ route('team_users.update', $teamUser->uuid) }}"
                                               class="btn btn-sm btn-neutral updateUser">
                                                <i class="bi bi-save"></i>
                                            </a>
                                            <a href="{{ route('team_users.destroy', $teamUser->uuid) }}"
                                               class="btn btn-sm btn-neutral destroyUser">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
                <div class="mt-4 mb-4">
                    <h5>{{ __('page.user.add_users')}}</h5>
                </div>
                <form class="team-user-form" method="POST" action="{{ route("team_users.store") }}">
                    @csrf
                    @method('POST')
                    <input type="hidden" id="user_id" value="{{ $id }}">
                    <div class="row">
                        <div class="col-md-3">
                            <x-form.select
                                name="team_id"
                                required
                                id="team_id"
                                label="{{ __('page.teams.title') }}"
                                class="form-select role"
                                :options="$teamsList"
                            />
                        </div>
                        <div class="col-md-3">
                            <x-form.select
                                name="role"
                                required
                                id="user_role"
                                label="{{ __('attributes.user.role') }}"
                                class="form-select role"
                                :hide-default-option="true"
                                :options="$roles"
                            />
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-success addUserToTeam">
                                <i class="bi bi-person-plus"></i>
                                {{ trans('page.user.add_users') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
