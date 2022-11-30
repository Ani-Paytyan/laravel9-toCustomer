@if ($workPlaceContacts->count() !== 0)
    <div class="mt-4 mb-4">
        <h4>{{ __('page.workplace.contacts')}} :</h4>
    </div>
    <div class="card mb-8">
        <div class="table-responsive">
            <table class="table table-hover table-nowrap">
                <thead class="table-light">
                <tr>
                    <th scope="col">{{ __('attributes.user.name')}}</th>
                    <th scope="col">{{ __('attributes.user.email')}}</th>
                    <th scope="col">{{ __('attributes.user.role')}}</th>
                    <th scope="col">{{ __('attributes.user.phone')}}</th>
                    <th scope="col">{{ __('common.actions')}}</th>
                </tr>
                </thead>
                <tbody class="contact-list">
                @foreach($workPlaceContacts as $workPlaceContact)
                    <tr>
                        <td>
                            <a href="{{ route('employees.show', $workPlaceContact->uuid) }}">
                                {{ $workPlaceContact->getFullNameAttribute() }}
                            </a>
                        </td>
                        <td>{{ $workPlaceContact->email }}</td>
                        <td>{{ $workPlaceContact->role }}</td>
                        <td>{{ $workPlaceContact->phone }}</td>
                        <td>
                            <a href="{{ route('employees.show', $workPlaceContact->uuid) }}"
                               class="btn btn-sm btn-neutral"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="{{ __('page.employees.employee') }}"
                            >
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            @if (Gate::allows('destroy-workplace-contacts'))
                                <button data-href="{{ route('workplace-employees.delete', [$workplace->uuid, $workPlaceContact->uuid]) }}"
                                   class="btn btn-sm btn-neutral destroyContact"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   type="button"
                                   title="{{ __('page.contact.delete') }}"
                                >
                                    <i class="bi bi-trash"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="navigation">
        {{ $workPlaceContacts->links() }}
    </div>
@endif
