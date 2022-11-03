<div class="mt-4 mb-4">
    <h5>{{ __('page.workplace.add_contact')}}</h5>
</div>
<form class="workplace-contacts-form" method="POST" action="{{ route("workplace-employees.store", $workplace->uuid) }}">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-md-6">
            <x-form.select
                name="contact_id"
                required
                id="contact_id"
                label="{{ __('page.workplace.contact') }}"
                class="form-select role"
                :options="$contactList"
            />
        </div>
        <div class="col-md-3">
            <button class="btn btn-success workplace-contacts-add">
                <i class="bi bi-person-plus"></i>
                {{ trans('page.workplace.add_contact_btn') }}
            </button>
        </div>
    </div>
</form>
