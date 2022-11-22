<div class="card">
    <div class="card-header">
        <h4 class="mb-0">{{ __('page.workplace.contacts')}}</h4>
    </div>
    @if ($workPlaceContacts->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-records table-hover">
                <thead>
                <tr>
                    <th>{{ __('attributes.user.name')}}</th>
                    <th>{{ __('attributes.user.email')}}</th>
                    <th>{{ __('attributes.user.role')}}</th>
                    <th>{{ __('attributes.user.phone')}}</th>
                    <th>{{ __('common.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($workPlaceContacts as $workPlaceContact)
                    @if ($workPlaceContact)
                        <tr x-data="workplaceContactRow">
                            <td>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" x-show="loading"></span>
                                <a href="{{ route('employees.show', $workPlaceContact->uuid) }}">
                                    {{ $workPlaceContact->getFullNameAttribute() }}
                                </a>
                            </td>
                            <td>{{ $workPlaceContact->email }}</td>
                            <td>{{ $workPlaceContact->role }}</td>
                            <td>{{ $workPlaceContact->phone }}</td>
                            <td>
                                <a
                                    href="{{ route('employees.show', $workPlaceContact->uuid) }}"
                                    class="btn btn-square"
                                    title="{{ __('page.employees.employee') }}"
                                >
                                    <x-heroicon-o-eye />
                                </a>
                                @if (Gate::allows('destroy-workplace-contacts'))
                                    <button
                                        @click.prevent="destroy('{{ route('workplace-employees.delete', [$workplace->uuid, $workPlaceContact->uuid]) }}', '{{ __("Are you sure?") }}')"
                                        class="btn btn-square text-danger"
                                        title="{{ __('page.contact.delete') }}"
                                        :disabled="loading"
                                    >
                                        <x-heroicon-o-trash />
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
        @if ($workPlaceContacts->hasPages())
            <div class="card-footer pb-0">
                {{ $workPlaceContacts->links() }}
            </div>
        @endif
    @else
        <div class="card-body">
            <i class="text-muted">{{ __('No workplace\'s contacts') }}</i>
        </div>
    @endif
</div>
