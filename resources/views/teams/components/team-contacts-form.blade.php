<div class="mt-4 mb-4">
    <h5>{{ __('page.contact.add_contact')}}</h5>
</div>
<form class="team-contact-form" method="POST" action="{{ route("team-contacts.store") }}">
    @csrf
    @method('POST')
    <input type="hidden" id="team_id" value="{{ $team->uuid }}">
    <div class="row">
        <div class="col-md-3">
            <x-form.select
                name="contact_id"
                required
                id="contact_id"
                label="{{ __('page.teams.contact') }}"
                class="form-select role"
                :options="$contacts"
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
            <button class="btn btn-success addContactToTeam">
                <i class="bi bi-person-plus"></i>
                {{ trans('page.contact.add_contact_btn') }}
            </button>
        </div>
    </div>
</form>
