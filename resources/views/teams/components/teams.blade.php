<div>
    <div>
        <h5>{{ __('page.teams.users')}} {{ $team->name }}</h5>
    </div>
    <div class="card mb-12">
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
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>
                            <x-form.select
                                name="role"
                                required
                                placeholder="{{ __('attributes.user.role') }}"
                                class="form-select form-control-muted role"
                                :options="$roles"
                                value="{{ $user->role }}"
                            />
                        </td>
                        <td>
                            <a href="{{ route('team_users.update', $user->uuid) }}"
                               class="btn btn-sm btn-neutral updateUser">
                                <i class="bi bi-save"></i>
                            </a>
                            <form method="POST"
                                  action="{{ route('team_users.destroy', $user->uuid) }}">
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
</div>
