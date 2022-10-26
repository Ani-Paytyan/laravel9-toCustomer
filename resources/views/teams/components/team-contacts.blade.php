<div class="mt-4 mb-4">
    <h5>{{ __('page.teams.contacts')}} {{ $team->name }}</h5>
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
            <tbody class="clients-list">
            @foreach($teamContacts as $teamContact)
                <tr>
                    <td>{{ $teamContact->contact->first_name ? $teamContact->contact->getFullNameAttribute() : $teamContact->contact->email }}</td>
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
