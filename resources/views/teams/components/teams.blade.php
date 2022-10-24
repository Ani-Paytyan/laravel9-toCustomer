<div>
    <div class="mt-4 mb-4">
        <h5>{{ __('page.teams.users')}} {{ $team->name }}</h5>
    </div>
    <div class="card mb-8">
        <div class="table-responsive">
            <table class="table table-hover table-nowrap">
                <thead class="table-light">
                <tr>
                    <th scope="col">{{ __('attributes.user.name')}}</th>
                    <th scope="col">{{ __('attributes.team.description')}}</th>
                    <th scope="col">{{ __('common.actions')}}</th>
                </tr>
                </thead>
                <tbody class="users-list">
                @foreach($teamUsers as $teamUser)
                    <tr>
                        <td>{{ $teamUser->name }}</td>
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
    <div class="mt-4 mb-4">
        <h5>{{ __('page.user.add_users')}}</h5>
    </div>
    <form class="team-user-form" method="POST" action="{{ route("team_users.store") }}">
        @csrf
        @method('POST')
        <input type="hidden" id="team_id" value="{{ $team->uuid }}">
        <div class="row">
            <div class="col-md-3">
                <x-form.select
                    name="user_id"
                    required
                    id="user_id"
                    label="{{ __('page.teams.user') }}"
                    class="form-select role"
                    :options="$usersList"
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
                <button class="btn btn-success addUser">
                    <i class="bi bi-person-plus"></i>
                    {{ trans('page.user.add_user') }}
                </button>
            </div>
        </div>
    </form>
</div>
