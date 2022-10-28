@extends('layout.dashboard')
@section('title')
    {{ __('page.contact.contact_teams')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('layout.partials.messages')
        <div class="card mb-7">
            <div class="row card-header align-items-center">
                <div class="page-title">
                    <h3>{{ $employee->getFullNameAttribute() }} - {{ __('page.teams.title')}} </h3>
                </div>
                @if(!empty($contactTeams))
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-hover table-nowrap">
                                <thead class="table-light">
                                <tr>
                                    <th scope="col">{{ __('attributes.team.name')}}</th>
                                    <th scope="col">{{ __('attributes.user.role')}}</th>
                                    <th scope="col">{{ __('common.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contactTeams as $teamContact)
                                    <tr>
                                        <td>{{ $teamContact->team->name }}</td>
                                        <td>
                                            <x-form.select
                                                name="role"
                                                required
                                                placeholder="{{ __('attributes.user.role') }}"
                                                class="form-select role"
                                                :hide-default-option="true"
                                                :options="$roles"
                                                value="{{ $teamContact->role }}"
                                            />
                                        </td>
                                        <td>
                                            <a href="{{ route('team-contacts.update', $teamContact->uuid) }}"
                                               class="btn btn-sm btn-neutral updateContact">
                                                <i class="bi bi-save"></i>
                                            </a>
                                            <a href="{{ route('team-contacts.destroy', $teamContact->uuid) }}"
                                               class="btn btn-sm btn-neutral destroyContact">
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
                    <h5>{{ __('page.contact.team_add')}}</h5>
                </div>
                <form class="contact-team-form" method="POST" action="{{ route("team-contacts.store") }}">
                    @csrf
                    @method('POST')
                    <input type="hidden" id="contact_id" value="{{ $employee->uuid }}">
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
                                id="contact_role"
                                label="{{ __('attributes.user.role') }}"
                                class="form-select role"
                                :hide-default-option="true"
                                :options="$roles"
                            />
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-success addTeamToContact">
                                <i class="bi bi-person-plus"></i>
                                {{ trans('page.contact.team_add_btn') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
