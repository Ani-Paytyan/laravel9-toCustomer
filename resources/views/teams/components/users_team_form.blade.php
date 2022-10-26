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
