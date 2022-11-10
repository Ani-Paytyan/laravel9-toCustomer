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
                @if ($teamContact)
                    <tr>
                        <td>
                            <a href="{{ route('employees.show', $teamContact->uuid) }}">
                                {{ $teamContact->first_name ? $teamContact->getFullNameAttribute() : $teamContact->email }}
                            </a>
                        </td>
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
                            <a href="{{ route('employees.show', $teamContact->uuid) }}"
                               class="btn btn-sm btn-neutral"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="{{ __('page.employees.employee') }}"
                            >
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a href="{{ route('team-contacts.update', $teamContact->uuid) }}"
                               class="btn btn-sm btn-neutral updateContact"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="{{ __('page.employees.update') }}"
                            >
                                <span class="icon icon-disk">
                                    <span class="icon-inner"></span>
                                </span>
                            </a>
                            <a href="{{ route('team-contacts.destroy', $teamContact->pivot->uuid) }}"
                               class="btn btn-sm btn-neutral destroyContact"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="{{ __('page.employees.delete') }}"
                            >
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
</div>
