<div class="card">
    <div class="card-header">
        <h4 class="text-center text-md-left mb-0">{{ __('page.contact.add_contact') }}</h4>
    </div>
    <form
        class="mb-0"
        x-data="teamContactForm('{{ route("team-contacts.store") }}', '{{ $team->uuid }}')"
        x-bind="form"
    >
        @csrf
        @method('POST')
        <div class="card-body">
            <div class="mb-3">
                <label for="contact_id" class="form-label">
                    {{ __('page.teams.contact') }}
                    <span class="text-danger"> *</span>
                </label>
                <select id="contact_id" x-ref="contact" required>
                    <option value="">{{ __('Choose') }}</option>
                    @foreach($contacts as $optValue => $name)
                        <option value="{{ $optValue }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="contact_role" class="form-label">
                    {{ __('attributes.user.role') }}
                    <span class="text-danger"> *</span>
                </label>
                <select id="contact_role" x-ref="role" required>
                    <option value="">{{ __('Choose') }}</option>
                    @foreach($roles as $optValue => $name)
                        <option value="{{ $optValue }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-success" :disabled="loading">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" x-show="loading"></span>
                <x-heroicon-o-plus x-show="!loading" />
                {{ __('page.contact.add_contact_btn') }}
            </button>
        </div>
    </form>
</div>
