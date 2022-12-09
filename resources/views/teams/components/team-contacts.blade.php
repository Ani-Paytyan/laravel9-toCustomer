<div class="card">
    <div class="card-header">
        <h4 class="mb-0">{{ __('page.teams.contacts') }}: {{ $team->name }}</h4>
    </div>
    @if ($teamContacts->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-records table-hover">
                <thead>
                <tr>
                    <th width="30%">{{ __('attributes.user.name')}}</th>
                    <th width="40%">{{ __('attributes.team.description')}}</th>
                    <th width="30%">{{ __('common.actions')}}</th>
                </tr>
                </thead>
                <tbody class="clients-list">
                @foreach($teamContacts as $teamContact)
                    @if ($teamContact)
                        <tr x-data="teamContactRow">
                            <td>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" x-show="loading"></span>
                                <a href="{{ route('employees.show', $teamContact->uuid) }}">
                                    {{ $teamContact->first_name ? $teamContact->getFullNameAttribute() : $teamContact->email }}
                                </a>
                            </td>
                            <td>
                                <select
                                        @change="update('{{ route("team-contacts.update", $teamContact->uuid) }}')"
                                        class="form-control form-control-sm"
                                        aria-label="{{ __('attributes.user.role') }}"
                                        :disabled="loading"
                                        x-ref="role"
                                >
                                    @foreach($roles as $optValue => $name)
                                        <option value="{{ $optValue }}" @selected($teamContact->role === $optValue)>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="text-nowrap">
                                <a
                                        href="{{ route('employees.show', $teamContact->uuid) }}"
                                        class="btn btn-square"
                                        title="{{ __('page.employees.employee') }}"
                                        :class="{ disabled: loading }"
                                >
                                    <x-heroicon-o-eye />
                                </a>
                                <button
                                        @click.prevent="destroy('{{ route("team-contacts.destroy", $teamContact->pivot->uuid) }}', '{{ __("Are you sure?") }}')"
                                        class="btn btn-square text-danger"
                                        title="{{ __('page.employees.delete') }}"
                                        :disabled="loading"
                                >
                                    <x-heroicon-o-trash />
                                </button>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="card-body">
            <i class="text-muted">{{ __('No contacts') }}</i>
        </div>
    @endif
</div>
