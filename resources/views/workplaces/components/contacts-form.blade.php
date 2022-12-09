<div class="card">
    <div class="card-header">
        <h4 class="mb-0">{{ __('page.workplace.add_contact')}}</h4>
    </div>
    <form
        class="mb-0"
        method="POST"
        x-data="workplaceContactForm('{{ route("workplace-employees.store", $workplace->uuid) }}')"
        x-bind="form"
    >
        @csrf
        @method('POST')
        <div class="card-body">
            <div class="mb-3">
                <x-form.select
                    name="contact_id"
                    required
                    id="contact_id"
                    label="{{ __('page.workplace.contact') }}"
                    :options="$contactList"
                    x-ref="contact"
                />
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-success" :disabled="loading || disabledSubmit">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" x-show="loading"></span>
                <x-heroicon-o-plus x-show="!loading" />
                {{ __('page.workplace.add_contact_btn') }}
            </button>
        </div>
    </form>
</div>

