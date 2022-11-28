<div class="container-fluid">
    @include('layout.partials.messages')
    <div class="card mb-7">
        <div class="row card-header align-items-center">
            <div class="page-title">
                <h3>{{ __('page.teams.title')}} </h3>
            </div>
            @if($teams->count() !== 0)
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
                            @foreach($teams as $team)
                                <tr>
                                    <td>
                                        <a href="{{ route('teams.edit', $team->uuid) }}">
                                            {{ $team->name ?? $team->uuid }}
                                        </a>
                                    </td>
                                    <td>
                                        <x-form.select
                                            name="role"
                                            required
                                            placeholder="{{ __('attributes.user.role') }}"
                                            class="form-select role"
                                            :hide-default-option="true"
                                            :options="$teamRoles"
                                            value="{{ $team->role }}"
                                        />
                                    </td>
                                    <td>
                                        <a href="{{ route('teams.edit', $team->uuid) }}"
                                           class="btn btn-sm btn-neutral"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{ __('page.teams.title') }}"
                                        >
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="{{ route('team-contacts.update', $team->pivot->uuid) }}"
                                           class="btn btn-sm btn-neutral updateContact"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{ __('page.teams.update') }}"
                                        >
                                                <span class="icon icon-disk">
                                                    <span class="icon-inner"></span>
                                                </span>
                                        </a>
                                        <a href="{{ route('team-contacts.destroy', $team->pivot->uuid) }}"
                                           class="btn btn-sm btn-neutral destroyContact"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="{{ __('page.teams.delete') }}"
                                        >
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
            @if (!empty($teamsList))
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
                                :options="$teamRoles"
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
            @endif
        </div>
    </div>
</div>
